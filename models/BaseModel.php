<?php

class BaseModel
{
    protected PDO $db;
    protected string $table = '';

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function findAll(string $orderBy = 'id ASC', string $condition = '1=1'): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE {$condition} ORDER BY {$orderBy}");
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function findByField(string $field, mixed $value): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$field} = :value LIMIT 1");
        $stmt->execute(['value' => $value]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function count(string $condition = '1=1'): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table} WHERE {$condition}");
        return (int)$stmt->fetch()['total'];
    }
}
