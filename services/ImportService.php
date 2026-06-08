<?php

require_once BASE_PATH . '/models/ImportLog.php';

class ImportService
{
    private ImportLog $logModel;

    public function __construct()
    {
        $this->logModel = new ImportLog();
    }

    public function import(string $moduleName, array $file): array
    {
        if (empty($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'No file uploaded.'];
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExts = ['csv', 'xlsx', 'xls'];
        if (!in_array($ext, $allowedExts, true)) {
            return ['success' => false, 'error' => 'Invalid file type. Allowed: ' . implode(', ', $allowedExts)];
        }

        $this->logModel->create([
            'module_name'      => $moduleName,
            'file_name'        => $file['name'],
            'records_imported' => 0,
        ]);

        return [
            'success' => true,
            'message' => 'Import framework ready. Full parsing will be available in a future phase.',
            'file'    => $file['name'],
        ];
    }

    public function getRecentLogs(int $limit = 20): array
    {
        return $this->logModel->recent($limit);
    }
}
