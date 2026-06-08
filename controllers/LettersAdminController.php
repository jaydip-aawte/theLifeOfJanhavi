<?php

require_once BASE_PATH . '/models/OpenWhenLetter.php';
require_once BASE_PATH . '/controllers/ContentAdminController.php';

class LettersAdminController extends ContentAdminController
{
    protected string $pageSlug = 'letters';
    protected string $pageTitle = 'Open When Letters';
    protected string $pageIcon = '💌';
    protected string $uploadField = '';
    protected array $fields = [
        ['name' => 'title',          'label' => 'Letter Title',  'type' => 'text',     'required' => true],
        ['name' => 'category',       'label' => 'Category',      'type' => 'select',   'required' => true,
            'options' => [
                'sad'        => 'Open When Sad',
                'angry'      => 'Open When Angry',
                'happy'      => 'Open When Happy',
                'missing_me' => 'Open When Missing Me',
            ]],
        ['name' => 'letter_content', 'label' => 'Letter Content (Marathi + emoji ok)', 'type' => 'textarea', 'required' => true],
        ['name' => 'envelope_color', 'label' => 'Envelope Color', 'type' => 'select',  'required' => false,
            'options' => [
                'pink'     => 'Pink',
                'rose'     => 'Rose',
                'peach'    => 'Peach',
                'lavender' => 'Lavender',
                'cream'    => 'Cream',
            ]],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->model = new OpenWhenLetter();
    }
}
