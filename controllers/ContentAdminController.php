<?php

require_once BASE_PATH . '/services/UploadService.php';

abstract class ContentAdminController extends BaseController
{
    protected ContentModel $model;
    protected UploadService $uploader;
    protected string $pageSlug = '';
    protected string $pageTitle = '';
    protected string $pageIcon = '';
    protected string $uploadSubdir = 'photos';
    protected string $uploadField = '';
    protected array $fields = [];

    public function __construct()
    {
        $this->uploader = new UploadService();
    }

    public function handle(): void
    {
        $this->requireAdmin();
        $action = $_GET['action'] ?? 'index';
        match ($action) {
            'create'   => $this->form(),
            'store'    => $this->store(),
            'edit'     => $this->form((int)($_GET['id'] ?? 0)),
            'update'   => $this->doUpdate(),
            'delete'   => $this->delete(),
            'restore'  => $this->doRestore(),
            'toggle'   => $this->toggle(),
            'moveup'   => $this->doMoveUp(),
            'movedown' => $this->doMoveDown(),
            'bulk'     => $this->bulk(),
            default    => $this->index(),
        };
    }

    protected function index(): void
    {
        $records = $this->model->allRecords();
        $this->renderView('admin/content/list', [
            'records'    => $records,
            'fields'     => $this->fields,
            'pageSlug'   => $this->pageSlug,
            'pageTitle'  => $this->pageTitle,
            'pageIcon'   => $this->pageIcon,
            'activePage' => $this->pageSlug,
            'uploadField'=> $this->uploadField,
            'csrfField'  => $this->csrfField(),
        ]);
    }

    protected function form(int $id = 0): void
    {
        $record = $id > 0 ? $this->model->findById($id) : null;
        $this->renderView('admin/content/form', [
            'record'     => $record,
            'fields'     => $this->fields,
            'pageSlug'   => $this->pageSlug,
            'pageTitle'  => $this->pageTitle,
            'pageIcon'   => $this->pageIcon,
            'activePage' => $this->pageSlug,
            'csrfField'  => $this->csrfField(),
            'isEdit'     => $id > 0,
        ]);
    }

    protected function store(): void
    {
        if (!$this->isPost() || !$this->validateCsrf()) {
            $this->redirectToList('Invalid request.');
            return;
        }
        $data = $this->gatherFormData();
        $data['rank'] = $this->model->nextRank();

        if ($this->uploadField && !empty($_FILES[$this->uploadField]['tmp_name'])) {
            $result = $this->uploader->upload($_FILES[$this->uploadField], $this->uploadSubdir);
            if ($result['success']) {
                $data[$this->uploadField] = $result['path'];
            }
        }

        $this->model->create($data);
        $this->redirectToList('', 'Record created successfully!');
    }

    protected function doUpdate(): void
    {
        if (!$this->isPost() || !$this->validateCsrf()) {
            $this->redirectToList('Invalid request.');
            return;
        }
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            $this->redirectToList('Invalid ID.');
            return;
        }
        $data = $this->gatherFormData();

        if ($this->uploadField && !empty($_FILES[$this->uploadField]['tmp_name'])) {
            $result = $this->uploader->upload($_FILES[$this->uploadField], $this->uploadSubdir);
            if ($result['success']) {
                $old = $this->model->findById($id);
                if ($old && !empty($old[$this->uploadField])) {
                    $this->uploader->delete($old[$this->uploadField]);
                }
                $data[$this->uploadField] = $result['path'];
            }
        }

        $this->model->update($id, $data);
        $this->redirectToList('', 'Record updated successfully!');
    }

    protected function delete(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->model->softDelete($id);
        }
        $this->redirectToList('', 'Record deleted.');
    }

    protected function doRestore(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->model->restore($id);
        }
        $this->redirectToList('', 'Record restored.');
    }

    protected function toggle(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->model->toggleStatus($id);
        }
        $this->redirectToList('', 'Status toggled.');
    }

    protected function doMoveUp(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->model->moveUp($id);
        }
        $this->redirectToList();
    }

    protected function doMoveDown(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->model->moveDown($id);
        }
        $this->redirectToList();
    }

    protected function bulk(): void
    {
        if (!$this->isPost() || !$this->validateCsrf()) {
            $this->redirectToList('Invalid request.');
            return;
        }
        $ids = array_map('intval', $_POST['selected'] ?? []);
        $bulkAction = $_POST['bulk_action'] ?? '';
        $msg = '';
        if (!empty($ids)) {
            switch ($bulkAction) {
                case 'activate':
                    $this->model->bulkSetStatus($ids, 1);
                    $msg = count($ids) . ' records activated.';
                    break;
                case 'deactivate':
                    $this->model->bulkSetStatus($ids, 0);
                    $msg = count($ids) . ' records deactivated.';
                    break;
                case 'delete':
                    $this->model->bulkSoftDelete($ids);
                    $msg = count($ids) . ' records deleted.';
                    break;
            }
        }
        $this->redirectToList('', $msg);
    }

    protected function gatherFormData(): array
    {
        $data = [];
        foreach ($this->fields as $field) {
            $key = $field['name'];
            if (($field['type'] ?? 'text') === 'file') continue;
            $value = $_POST[$key] ?? '';
            if (!empty($field['sanitize']) || ($field['type'] ?? 'text') !== 'textarea') {
                $value = $this->sanitize($value);
            } else {
                $value = trim($value);
            }
            $data[$key] = $value;
        }
        return $data;
    }

    protected function redirectToList(string $error = '', string $success = ''): void
    {
        $url = BASE_URL . '/admin/?page=' . $this->pageSlug;
        if ($error) {
            $_SESSION['flash_error'] = $error;
        }
        if ($success) {
            $_SESSION['flash_success'] = $success;
        }
        $this->redirect($url);
    }

    protected function renderView(string $viewPath, array $data = []): void
    {
        $this->view($viewPath, $data);
    }
}
