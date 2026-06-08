<?php

require_once BASE_PATH . '/models/JanhaviSapkal.php';
require_once BASE_PATH . '/controllers/ContentAdminController.php';

class SapkalAdminController extends ContentAdminController
{
    protected string $pageSlug = 'sapkal';
    protected string $pageTitle = 'Janhavi Sapkal';
    protected string $pageIcon = '👩';
    protected string $uploadSubdir = 'profile';
    protected string $uploadField = 'image_path';
    protected array $fields = [
        ['name' => 'title',       'label' => 'Title',       'type' => 'text',     'required' => true],
        ['name' => 'subtitle',    'label' => 'Subtitle',    'type' => 'text',     'required' => false],
        ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'required' => false],
        ['name' => 'icon',        'label' => 'Icon (emoji)', 'type' => 'text',    'required' => false],
        ['name' => 'image_path',  'label' => 'Image',       'type' => 'file',     'required' => false],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->model = new JanhaviSapkal();
    }
}
