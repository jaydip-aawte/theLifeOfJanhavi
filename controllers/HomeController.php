<?php

require_once __DIR__ . '/../models/LandingPage.php';
require_once __DIR__ . '/../models/Menu.php';
require_once __DIR__ . '/../models/Setting.php';

class HomeController extends BaseController
{
    public function index(): void
    {
        $appConfig = require BASE_PATH . '/config/app.php';

        // Attempt DB data; fall back to defaults if DB is unavailable
        try {
            $landingModel = new LandingPage();
            $menuModel = new Menu();

            $landing = $landingModel->getActive();
            $menus = $menuModel->getActiveMenus();
        } catch (\Throwable $e) {
            $landing = null;
            $menus = [];
        }

        $heroImage = $landing['hero_image'] ?? '/assets/images/hero-placeholder.svg';
        $bgMusic = $landing['background_music'] ?? null;

        // Default menu cards if DB is empty
        if (empty($menus)) {
            $menus = [
                ['module_name' => 'Wish For Janhavi', 'route' => '#', 'icon' => '🎁', 'rank' => 1],
                ['module_name' => 'Janhavi Sapkal', 'route' => '#', 'icon' => '👩', 'rank' => 2],
                ['module_name' => 'Janhavi Ek Chatpati Ladki', 'route' => '#', 'icon' => '🌶️', 'rank' => 3],
                ['module_name' => 'Love Treasure', 'route' => '#', 'icon' => '💎', 'rank' => 4],
                ['module_name' => 'Fun Zone', 'route' => '#', 'icon' => '🎮', 'rank' => 5],
            ];
        }

        $this->view('home/index', [
            'appConfig' => $appConfig,
            'landing'   => $landing,
            'heroImage' => $heroImage,
            'bgMusic'   => $bgMusic,
            'menus'     => $menus,
        ]);
    }
}
