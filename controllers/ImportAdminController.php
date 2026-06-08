<?php

require_once BASE_PATH . '/services/ImportService.php';

class ImportAdminController extends BaseController
{
    private ImportService $importService;

    public function __construct()
    {
        $this->importService = new ImportService();
    }

    public function index(): void
    {
        $this->requireAdmin();
        $logs = $this->importService->getRecentLogs();
        $message = '';
        $error = '';

        if ($this->isPost()) {
            if (!$this->validateCsrf()) {
                $error = 'Invalid request.';
            } else {
                $module = $this->sanitize($_POST['module_name'] ?? '');
                $file = $_FILES['import_file'] ?? [];
                $result = $this->importService->import($module, $file);
                if ($result['success']) {
                    $message = $result['message'];
                    $logs = $this->importService->getRecentLogs();
                } else {
                    $error = $result['error'];
                }
            }
        }

        $this->view('admin/import', [
            'pageTitle'  => 'Import Data',
            'activePage' => 'import',
            'logs'       => $logs,
            'message'    => $message,
            'error'      => $error,
            'csrfField'  => $this->csrfField(),
        ]);
    }
}
