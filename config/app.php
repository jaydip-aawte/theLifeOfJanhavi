<?php

/**
 * Auto-detect the base URL (scheme + host + sub-folder) from the current request.
 * This lets the project run from ANY location — domain root, a sub-folder on
 * XAMPP (e.g. http://localhost/theLifeOfJanhavi), or the PHP built-in server —
 * without editing any config. An explicit APP_URL env var always wins.
 */
if (!function_exists('lj_detect_base_url')) {
    function lj_detect_base_url(): string
    {
        // Scheme (honours reverse proxies)
        $https = (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
            || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https')
            || ((int)($_SERVER['SERVER_PORT'] ?? 80) === 443);
        $scheme = $https ? 'https' : 'http';

        // Host
        $host = $_SERVER['HTTP_HOST'] ?? ($_SERVER['SERVER_NAME'] ?? 'localhost');

        // Sub-folder: derive from the executing script's directory.
        // Public  : /sub/index.php        -> /sub
        // Admin   : /sub/admin/index.php  -> /sub/admin -> strip /admin -> /sub
        $script = $_SERVER['SCRIPT_NAME'] ?? '';
        $dir = str_replace('\\', '/', dirname($script));
        $dir = preg_replace('#/admin$#', '', $dir);   // admin front controller
        $dir = rtrim($dir, '/');
        if ($dir === '.' || $dir === '/') {
            $dir = '';
        }

        return $scheme . '://' . $host . $dir;
    }
}

return [
    'name'      => 'TheLifeOfJanhavi',
    'base_url'  => getenv('APP_URL') ?: lj_detect_base_url(),
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
