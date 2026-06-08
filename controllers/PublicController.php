<?php

require_once __DIR__ . '/../models/WishPhoto.php';
require_once __DIR__ . '/../models/WishVideo.php';
require_once __DIR__ . '/../models/JanhaviSapkal.php';
require_once __DIR__ . '/../models/JanhaviJaydip.php';
require_once __DIR__ . '/../models/ChatpatiJanhavi.php';
require_once __DIR__ . '/../models/OpenWhenLetter.php';

class PublicController extends BaseController
{
    public function wishPhoto(): void
    {
        try {
            $model = new WishPhoto();
            $records = $model->activeRecords();
        } catch (\Throwable $e) {
            $records = [];
        }
        $this->view('public/wish-photo', [
            'records'   => $records,
            'pageTitle' => 'Wish For Janhavi 🎁',
        ]);
    }

    public function wishVideo(): void
    {
        try {
            $model = new WishVideo();
            $records = $model->activeRecords();
        } catch (\Throwable $e) {
            $records = [];
        }
        $this->view('public/wish-video', [
            'records'   => $records,
            'pageTitle' => 'Video Wishes 🎬',
        ]);
    }

    public function janhaviSapkal(): void
    {
        try {
            $model = new JanhaviSapkal();
            $records = $model->activeRecords();
        } catch (\Throwable $e) {
            $records = [];
        }
        $this->view('public/janhavi-sapkal', [
            'records'   => $records,
            'pageTitle' => 'Janhavi Sapkal 👩',
        ]);
    }

    public function janhaviJaydip(): void
    {
        try {
            $model = new JanhaviJaydip();
            $records = $model->activeRecords();
        } catch (\Throwable $e) {
            $records = [];
        }
        try {
            $letters = (new OpenWhenLetter())->byCategories(['missing_me']);
        } catch (\Throwable $e) {
            $letters = [];
        }
        $this->view('public/janhavi-jaydip', [
            'records'   => $records,
            'letters'   => $letters,
            'pageTitle' => 'Janhavi Jaydip 💕',
        ]);
    }

    public function chatpatiJanhavi(): void
    {
        try {
            $model = new ChatpatiJanhavi();
            $records = $model->activeRecords();
        } catch (\Throwable $e) {
            $records = [];
        }
        try {
            $letters = (new OpenWhenLetter())->byCategories(['sad', 'angry', 'happy']);
        } catch (\Throwable $e) {
            $letters = [];
        }
        $this->view('public/chatpati-janhavi', [
            'records'   => $records,
            'letters'   => $letters,
            'pageTitle' => 'Chatpati Janhavi 🌶️',
        ]);
    }

    public function loveTreasure(): void
    {
        $this->view('public/love-treasure', [
            'pageTitle' => 'Love Treasure 💎',
        ]);
    }
}
