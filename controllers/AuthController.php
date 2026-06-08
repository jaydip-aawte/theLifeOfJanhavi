<?php

require_once __DIR__ . '/../models/Admin.php';

class AuthController extends BaseController
{
    private Admin $adminModel;

    public function __construct()
    {
        try {
            $this->adminModel = new Admin();
        } catch (\Throwable $e) {
            // DB not ready — handled in methods
        }
    }

    public function login(): void
    {
        if ($this->isAdmin()) {
            $this->redirect(BASE_URL . '/admin/?page=dashboard');
        }

        $error = '';

        if ($this->isPost()) {
            if (!$this->validateCsrf()) {
                $error = 'Invalid request. Please try again.';
            } else {
                $username = trim($_POST['username'] ?? '');
                $password = $_POST['password'] ?? '';

                $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

                try {
                    // Rate limiting
                    $attempts = $this->adminModel->getLoginAttempts($ip);
                    $appConfig = require BASE_PATH . '/config/app.php';
                    $maxAttempts = $appConfig['rate_limit']['max_attempts'];

                    if ($attempts >= $maxAttempts) {
                        $error = 'Too many login attempts. Please wait 15 minutes.';
                    } else {
                        $admin = $this->adminModel->findByUsername($username);

                        if ($admin && $this->adminModel->verifyPassword($password, $admin['password'])) {
                            // Regenerate session ID to prevent fixation
                            session_regenerate_id(true);

                            $_SESSION['admin_logged_in'] = true;
                            $_SESSION['admin_id'] = $admin['id'];
                            $_SESSION['admin_username'] = $admin['username'];
                            $_SESSION['admin_login_time'] = time();

                            $this->adminModel->clearLoginAttempts($ip);
                            $this->adminModel->recordLoginAttempt($ip, true);

                            $this->redirect(BASE_URL . '/admin/?page=dashboard');
                        } else {
                            $this->adminModel->recordLoginAttempt($ip, false);
                            $error = 'Invalid username or password.';
                        }
                    }
                } catch (\Throwable $e) {
                    $error = 'Login service unavailable. Please configure the database.';
                }
            }
        }

        $this->view('auth/login', [
            'error' => $error,
            'csrfField' => $this->csrfField(),
        ]);
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        session_destroy();
        $this->redirect(BASE_URL . '/admin/?page=login');
    }
}
