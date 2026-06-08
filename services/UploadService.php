<?php

class UploadService
{
    private array $allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];
    private int $maxSize;
    private string $uploadBase;

    public function __construct()
    {
        $appConfig = require BASE_PATH . '/config/app.php';
        $this->maxSize = $appConfig['upload']['max_size'] ?? 5 * 1024 * 1024;
        $this->uploadBase = BASE_PATH . '/assets/uploads';
    }

    public function upload(array $file, string $subdir = 'photos'): array
    {
        if (empty($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'No file uploaded or upload error.'];
        }

        if ($file['size'] > $this->maxSize) {
            $mb = round($this->maxSize / 1024 / 1024, 1);
            return ['success' => false, 'error' => "File too large. Max {$mb}MB."];
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $this->allowedTypes, true)) {
            return ['success' => false, 'error' => 'Invalid file type. Allowed: ' . implode(', ', $this->allowedTypes)];
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        $validMimes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($mime, $validMimes, true)) {
            return ['success' => false, 'error' => 'Invalid file content type.'];
        }

        $dir = $this->uploadBase . '/' . $subdir;
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $uniqueName = uniqid('img_', true) . '_' . time() . '.' . $ext;
        $destPath = $dir . '/' . $uniqueName;

        if (!move_uploaded_file($file['tmp_name'], $destPath)) {
            return ['success' => false, 'error' => 'Failed to save file.'];
        }

        $relativePath = '/assets/uploads/' . $subdir . '/' . $uniqueName;
        return ['success' => true, 'path' => $relativePath, 'filename' => $uniqueName];
    }

    public function delete(string $relativePath): bool
    {
        $fullPath = BASE_PATH . $relativePath;
        if (file_exists($fullPath) && is_file($fullPath)) {
            return unlink($fullPath);
        }
        return false;
    }
}
