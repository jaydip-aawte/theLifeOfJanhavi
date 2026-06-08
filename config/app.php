<?php

return [
    'name'      => 'TheLifeOfJanhavi',
    'base_url'  => getenv('APP_URL') ?: 'http://localhost:8000',
    'debug'     => (bool)(getenv('APP_DEBUG') ?: false),
    'timezone'  => 'Asia/Kolkata',
    'charset'   => 'UTF-8',
    'version'   => '1.0.0',

    'meta' => [
        'title'       => '💓 TheLifeOfJanhavi 💓',
        'description' => 'A digital emotional scrapbook built with love for Janhavi — memories, laughter, dreams and countless emotions.',
        'keywords'    => 'Janhavi, scrapbook, memories, birthday, personal',
        'author'      => 'Jaydip',
        'og_image'    => '/assets/images/og-cover.svg',
    ],

    'admin_prefix' => '/admin',

    'rate_limit' => [
        'max_attempts'  => 5,
        'decay_minutes' => 15,
    ],

    'upload' => [
        'max_size'    => 5 * 1024 * 1024, // 5MB
        'allowed_img' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
        'allowed_audio'=> ['mp3', 'ogg', 'wav'],
    ],
];
