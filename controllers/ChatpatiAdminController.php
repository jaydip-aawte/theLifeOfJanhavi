<?php

require_once BASE_PATH . '/models/ChatpatiJanhavi.php';
require_once BASE_PATH . '/controllers/ContentAdminController.php';

class ChatpatiAdminController extends ContentAdminController
{
    protected string $pageSlug = 'chatpati';
    protected string $pageTitle = 'Chatpati Janhavi';
    protected string $pageIcon = '🌶️';
    protected string $uploadSubdir = 'memes';
    protected string $uploadField = 'image_path';
    protected array $fields = [
        ['name' => 'title',       'label' => 'Title',       'type' => 'text',     'required' => true],
        ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'required' => false],
        ['name' => 'meme_text',   'label' => 'Meme Text',   'type' => 'text',     'required' => false],
        ['name' => 'image_path',  'label' => 'Image',       'type' => 'file',     'required' => false],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->model = new ChatpatiJanhavi();
    }
}
