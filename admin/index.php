<?php

/**
 * TheLifeOfJanhavi — Admin Front Controller
 * Physical /admin/ entry point (reliable on cPanel shared hosting).
 * Pages are dispatched via ?page=... (defaults to dashboard).
 */

$appConfig = require __DIR__ . '/../config/app.php';

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

date_default_timezone_set($appConfig['timezone']);
mb_internal_encoding($appConfig['charset']);

// Path constants (BASE_PATH = project root)
define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', rtrim($appConfig['base_url'], '/'));
define('ADMIN_URL', BASE_URL . '/admin');

// Bootstrap core
require_once BASE_PATH . '/config/Database.php';
require_once BASE_PATH . '/controllers/BaseController.php';
require_once BASE_PATH . '/models/BaseModel.php';
require_once BASE_PATH . '/config/session.php';

// Load admin controllers
require_once BASE_PATH . '/controllers/AuthController.php';
require_once BASE_PATH . '/controllers/AdminController.php';

// Page dispatch map
$page = isset($_GET['page']) ? trim($_GET['page']) : 'dashboard';

$pages = [
    'login'       => ['AuthController', 'login'],
    'logout'      => ['AuthController', 'logout'],
    'dashboard'   => ['AdminController', 'dashboard'],
    'landing'     => ['AdminController', 'landing'],
    'menus'       => ['AdminController', 'menus'],
    'music'       => ['AdminController', 'music'],
    'settings'    => ['AdminController', 'settings'],
    'credentials' => ['AdminController', 'credentials'],
];

if (!array_key_exists($page, $pages)) {
    $page = 'dashboard';
}

[$controllerName, $action] = $pages[$page];
$controller = new $controllerName();
$controller->$action();
