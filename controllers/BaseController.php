<?php

class BaseController
{
    protected function view(string $viewPath, array $data = []): void
    {
        extract($data);
        $viewFile = BASE_PATH . '/views/' . $viewPath . '.php';

        if (!file_exists($viewFile)) {
            http_response_code(500);
            die('View not found: ' . htmlspecialchars($viewPath));
        }

        require $viewFile;
    }

    protected function json(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function validateCsrf(): bool
    {
        $token = $_POST['csrf_token'] ?? '';
        return hash_equals($_SESSION['csrf_token'] ?? '', $token);
    }

    protected function csrfField(): string
    {
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($_SESSION['csrf_token'] ?? '') . '">';
    }

    protected function isAdmin(): bool
    {
        return !empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }

    protected function requireAdmin(): void
    {
        if (!$this->isAdmin()) {
            $this->redirect(BASE_URL . '/admin/?page=login');
        }
    }

    protected function sanitize(string $input): string
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
}
