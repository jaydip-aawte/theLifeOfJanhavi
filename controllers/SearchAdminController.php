<?php

require_once BASE_PATH . '/models/WishPhoto.php';
require_once BASE_PATH . '/models/WishVideo.php';
require_once BASE_PATH . '/models/JanhaviSapkal.php';
require_once BASE_PATH . '/models/JanhaviJaydip.php';
require_once BASE_PATH . '/models/ChatpatiJanhavi.php';
require_once BASE_PATH . '/models/OpenWhenLetter.php';
require_once BASE_PATH . '/models/EmotionalQuote.php';

class SearchAdminController extends BaseController
{
    public function index(): void
    {
        $this->requireAdmin();
        $q = trim($_GET['q'] ?? '');
        $results = [];

        if ($q !== '') {
            $modules = [
                ['model' => new WishPhoto(),       'label' => 'Wish Photos',      'icon' => '🎁', 'page' => 'wish-photo'],
                ['model' => new WishVideo(),       'label' => 'Wish Videos',      'icon' => '🎬', 'page' => 'wish-video'],
                ['model' => new JanhaviSapkal(),   'label' => 'Janhavi Sapkal',   'icon' => '👩', 'page' => 'sapkal'],
                ['model' => new JanhaviJaydip(),   'label' => 'Janhavi Jaydip',   'icon' => '💕', 'page' => 'jaydip'],
                ['model' => new ChatpatiJanhavi(), 'label' => 'Chatpati Janhavi', 'icon' => '🌶️', 'page' => 'chatpati'],
                ['model' => new OpenWhenLetter(),  'label' => 'Open When Letters', 'icon' => '💌', 'page' => 'letters'],
                ['model' => new EmotionalQuote(),  'label' => 'Emotional Quotes',  'icon' => '💭', 'page' => 'quotes'],
            ];
            foreach ($modules as $mod) {
                $rows = $mod['model']->search($q);
                if (!empty($rows)) {
                    $results[] = [
                        'label'   => $mod['label'],
                        'icon'    => $mod['icon'],
                        'page'    => $mod['page'],
                        'records' => $rows,
                    ];
                }
            }
        }

        $this->view('admin/search', [
            'pageTitle'  => 'Search',
            'activePage' => 'search',
            'q'          => $q,
            'results'    => $results,
        ]);
    }
}
