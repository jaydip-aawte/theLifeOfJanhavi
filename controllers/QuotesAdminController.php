<?php

require_once BASE_PATH . '/models/EmotionalQuote.php';
require_once BASE_PATH . '/controllers/ContentAdminController.php';

class QuotesAdminController extends ContentAdminController
{
    protected string $pageSlug = 'quotes';
    protected string $pageTitle = 'Emotional Quotes';
    protected string $pageIcon = '💭';
    protected string $uploadField = '';
    protected array $fields = [
        ['name' => 'quote_text',  'label' => 'Quote (Marathi + emoji ok)', 'type' => 'textarea', 'required' => true],
        ['name' => 'author_text', 'label' => 'Author / Tag',               'type' => 'text',     'required' => false],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->model = new EmotionalQuote();
    }
}
