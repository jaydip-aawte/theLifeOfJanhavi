<?php

require_once __DIR__ . '/../models/Menu.php';
require_once __DIR__ . '/../models/Setting.php';
require_once __DIR__ . '/../models/LandingPage.php';

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
            $landingModel = new LandingPage();

            $stats = [
                'total_menus'   => $menuModel->count("status = 1"),
                'landing_pages' => $landingModel->count(),
            ];
        } catch (\Throwable $e) {
            $stats = ['total_menus' => 0, 'landing_pages' => 0];
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
