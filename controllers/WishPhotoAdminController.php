<?php

require_once BASE_PATH . '/models/WishPhoto.php';
require_once BASE_PATH . '/controllers/ContentAdminController.php';

class WishPhotoAdminController extends ContentAdminController
{
    protected string $pageSlug = 'wish-photo';
    protected string $pageTitle = 'Wish Photos';
    protected string $pageIcon = '🎁';
    protected string $uploadSubdir = 'photos';
    protected string $uploadField = 'photo_path';
    protected array $fields = [
        ['name' => 'name',       'label' => 'Friend Name',  'type' => 'text',     'required' => true],
        ['name' => 'wish_text',  'label' => 'Wish Message', 'type' => 'textarea', 'required' => false],
        ['name' => 'wish_date',  'label' => 'Date',         'type' => 'date',     'required' => false],
        ['name' => 'photo_path', 'label' => 'Photo',        'type' => 'file',     'required' => false],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->model = new WishPhoto();
    }
}
