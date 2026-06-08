<?php

require_once __DIR__ . '/../models/Menu.php';
require_once __DIR__ . '/../models/Setting.php';
require_once __DIR__ . '/../models/LandingPage.php';
require_once __DIR__ . '/../models/WishPhoto.php';
require_once __DIR__ . '/../models/WishVideo.php';
require_once __DIR__ . '/../models/JanhaviSapkal.php';
require_once __DIR__ . '/../models/JanhaviJaydip.php';
require_once __DIR__ . '/../models/ChatpatiJanhavi.php';
require_once __DIR__ . '/../models/ImportLog.php';

class AdminController extends BaseController
{
    public function __construct()
    {
        // All admin routes require login
    }

    public function dashboard(): void
    {
        $this->requireAdmin();

        $stats = [];
        try {
            $menuModel = new Menu();
            $wishPhoto = new WishPhoto();
            $wishVideo = new WishVideo();
            $sapkal = new JanhaviSapkal();
            $jaydip = new JanhaviJaydip();
            $chatpati = new ChatpatiJanhavi();
            $importLog = new ImportLog();

            $totalPhotos = $wishPhoto->countAll();
            $totalVideos = $wishVideo->countAll();
            $activeContent = $wishPhoto->countActive() + $wishVideo->countActive()
                + $sapkal->countActive() + $jaydip->countActive() + $chatpati->countActive();

            $recentImport = $importLog->recent(1);
            $lastImport = !empty($recentImport) ? $recentImport[0]['created_at'] : null;

            $stats = [
                'total_photos'   => $totalPhotos,
                'total_videos'   => $totalVideos,
                'total_wishes'   => $totalPhotos + $totalVideos,
                'total_modules'  => $menuModel->count("status = 1"),
                'active_content' => $activeContent,
                'last_import'    => $lastImport,
            ];
        } catch (\Throwable $e) {
            $stats = [
                'total_photos'   => 0,
                'total_videos'   => 0,
                'total_wishes'   => 0,
                'total_modules'  => 0,
                'active_content' => 0,
                'last_import'    => null,
            ];
        }

        $this->view('admin/dashboard', [
            'stats'      => $stats,
            'pageTitle'  => 'Dashboard',
            'activePage' => 'dashboard',
        ]);
    }

    public function landing(): void
    {
        $this->requireAdmin();
        $this->view('admin/landing', [
            'pageTitle'  => 'Landing Page Management',
            'activePage' => 'landing',
        ]);
    }

    public function menus(): void
    {
        $this->requireAdmin();
        $this->view('admin/menus', [
            'pageTitle'  => 'Menu Management',
            'activePage' => 'menus',
        ]);
    }

    public function settings(): void
    {
        $this->requireAdmin();
        $this->view('admin/settings', [
            'pageTitle'  => 'Settings',
            'activePage' => 'settings',
        ]);
    }

    public function music(): void
    {
        $this->requireAdmin();
        $this->view('admin/music', [
            'pageTitle'  => 'Music Management',
            'activePage' => 'music',
        ]);
    }

    public function credentials(): void
    {
        $this->requireAdmin();
        $this->view('admin/credentials', [
            'pageTitle'  => 'Credentials',
            'activePage' => 'credentials',
        ]);
    }
}
