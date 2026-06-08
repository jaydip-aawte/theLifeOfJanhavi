<?php

/**
 * TheLifeOfJanhavi — Public Front Controller
 * All public requests route through here via .htaccess
 */

// Load app config
$appConfig = require __DIR__ . '/config/app.php';

// Error reporting
if ($appConfig['debug']) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    define('APP_DEBUG', true);
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
    define('APP_DEBUG', false);
}

// Timezone + encoding
date_default_timezone_set($appConfig['timezone']);
mb_internal_encoding($appConfig['charset']);

// Path constants
define('BASE_PATH', __DIR__);
define('BASE_URL', rtrim($appConfig['base_url'], '/'));

// Bootstrap core
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/controllers/BaseController.php';
require_once __DIR__ . '/models/BaseModel.php';

// Secure session
require_once __DIR__ . '/config/session.php';

// Parse route
$route = isset($_GET['route']) ? trim($_GET['route'], '/') : '';

// Public route map
$routes = [
    ''                  => ['HomeController', 'index'],
    'home'              => ['HomeController', 'index'],
    'wish-photo'        => ['PublicController', 'wishPhoto'],
    'wish-video'        => ['PublicController', 'wishVideo'],
    'janhavi-sapkal'    => ['PublicController', 'janhaviSapkal'],
    'janhavi-jaydip'    => ['PublicController', 'janhaviJaydip'],
    'chatpati-janhavi'  => ['PublicController', 'chatpatiJanhavi'],
    'api/landing-data'  => ['ApiController', 'landingData'],
    'api/menu-data'     => ['ApiController', 'menuData'],
];

// Redirect /admin to the physical admin front controller
if ($route === 'admin' || str_starts_with($route, 'admin/')) {
    header('Location: ' . BASE_URL . '/admin/');
    exit;
}

// Load controllers
require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/ApiController.php';
require_once __DIR__ . '/controllers/PublicController.php';

// Dispatch
if (array_key_exists($route, $routes)) {
    [$controllerName, $action] = $routes[$route];
    $controller = new $controllerName();
    $controller->$action();
} else {
    http_response_code(404);
    require __DIR__ . '/views/layouts/404.php';
}
