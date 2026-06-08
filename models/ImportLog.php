<?php

require_once __DIR__ . '/BaseModel.php';

class ImportLog extends BaseModel
{
    protected string $table = 'import_log';

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (module_name, file_name, records_imported) VALUES (:module_name, :file_name, :records_imported)"
        );
        $stmt->execute([
            'module_name'      => $data['module_name'],
            'file_name'        => $data['file_name'],
            'records_imported' => (int)($data['records_imported'] ?? 0),
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function recent(int $limit = 20): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :lim");
        $stmt->bindValue('lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
