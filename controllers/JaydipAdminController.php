<?php

require_once BASE_PATH . '/models/JanhaviJaydip.php';
require_once BASE_PATH . '/controllers/ContentAdminController.php';

class JaydipAdminController extends ContentAdminController
{
    protected string $pageSlug = 'jaydip';
    protected string $pageTitle = 'Janhavi Jaydip';
    protected string $pageIcon = '💕';
    protected string $uploadSubdir = 'profile';
    protected string $uploadField = 'image_path';
    protected array $fields = [
        ['name' => 'title',             'label' => 'Title',        'type' => 'text',     'required' => true],
        ['name' => 'subtitle',          'label' => 'Subtitle',     'type' => 'text',     'required' => false],
        ['name' => 'description',       'label' => 'Description',  'type' => 'textarea', 'required' => false],
        ['name' => 'content_type',      'label' => 'Content Type', 'type' => 'select',   'required' => true,
         'options' => ['photo' => 'Photo', 'story' => 'Story', 'memory' => 'Memory', 'video' => 'Video', 'letter' => 'Letter']],
        ['name' => 'youtube_embed_url', 'label' => 'YouTube URL',  'type' => 'text',     'required' => false],
        ['name' => 'image_path',        'label' => 'Image',        'type' => 'file',     'required' => false],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->model = new JanhaviJaydip();
    }

    protected function store(): void
    {
        if (!$this->isPost() || !$this->validateCsrf()) {
            $this->redirectToList('Invalid request.');
            return;
        }
        $data = $this->gatherFormData();
        $data['rank'] = $this->model->nextRank();
        if (!empty($data['youtube_embed_url'])) {
            $data['youtube_embed_url'] = WishVideo::toEmbedUrl($data['youtube_embed_url']);
        }
        if ($this->uploadField && !empty($_FILES[$this->uploadField]['tmp_name'])) {
            $result = $this->uploader->upload($_FILES[$this->uploadField], $this->uploadSubdir);
            if ($result['success']) {
                $data[$this->uploadField] = $result['path'];
            }
        }
        $this->model->create($data);
        $this->redirectToList('', 'Record created!');
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
        if (!empty($data['youtube_embed_url'])) {
            $data['youtube_embed_url'] = WishVideo::toEmbedUrl($data['youtube_embed_url']);
        }
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
        $this->redirectToList('', 'Record updated!');
    }
}
