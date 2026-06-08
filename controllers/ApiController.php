<?php

require_once __DIR__ . '/../models/LandingPage.php';
require_once __DIR__ . '/../models/Menu.php';
require_once __DIR__ . '/../models/EmotionalQuote.php';

class ApiController extends BaseController
{
    public function landingData(): void
    {
        try {
            $model = new LandingPage();
            $data = $model->getActive();
            $this->json(['success' => true, 'data' => $data]);
        } catch (\Throwable $e) {
            $this->json(['success' => false, 'message' => 'Service unavailable'], 503);
        }
    }

    public function menuData(): void
    {
        try {
            $model = new Menu();
            $data = $model->getActiveMenus();
            $this->json(['success' => true, 'data' => $data]);
        } catch (\Throwable $e) {
            $this->json(['success' => false, 'message' => 'Service unavailable'], 503);
        }
    }

    public function randomQuote(): void
    {
        try {
            $quote = (new EmotionalQuote())->random();
            $this->json(['success' => true, 'data' => $quote]);
        } catch (\Throwable $e) {
            $this->json(['success' => false, 'message' => 'Service unavailable'], 503);
        }
    }
}
