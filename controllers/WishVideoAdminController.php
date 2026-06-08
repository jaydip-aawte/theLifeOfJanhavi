<?php

require_once BASE_PATH . '/models/WishVideo.php';
require_once BASE_PATH . '/controllers/ContentAdminController.php';

class WishVideoAdminController extends ContentAdminController
{
    protected string $pageSlug = 'wish-video';
    protected string $pageTitle = 'Wish Videos';
    protected string $pageIcon = '🎬';
    protected string $uploadField = '';
    protected array $fields = [
        ['name' => 'name',        'label' => 'Friend Name',  'type' => 'text',     'required' => true],
        ['name' => 'wish_text',   'label' => 'Wish Message', 'type' => 'textarea', 'required' => false],
        ['name' => 'youtube_url', 'label' => 'YouTube URL',  'type' => 'text',     'required' => true],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->model = new WishVideo();
    }

    protected function store(): void
    {
        if (!$this->isPost() || !$this->validateCsrf()) {
            $this->redirectToList('Invalid request.');
            return;
        }
        $data = $this->gatherFormData();
        $data['rank'] = $this->model->nextRank();
        if (!empty($data['youtube_url'])) {
            $data['youtube_embed_url'] = WishVideo::toEmbedUrl($data['youtube_url']);
        }
        $this->model->create($data);
        $this->redirectToList('', 'Video wish created!');
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
        if (!empty($data['youtube_url'])) {
            $data['youtube_embed_url'] = WishVideo::toEmbedUrl($data['youtube_url']);
        }
        $this->model->update($id, $data);
        $this->redirectToList('', 'Video wish updated!');
    }
}
