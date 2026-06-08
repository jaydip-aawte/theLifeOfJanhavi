<?php

require_once __DIR__ . '/BaseModel.php';

class ContentModel extends BaseModel
{
    protected array $fillable = [];
    protected array $searchable = [];

    public function allRecords(bool $includeDeleted = false): array
    {
        $where = $includeDeleted ? '1=1' : 'deleted_at IS NULL';
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE {$where} ORDER BY rank ASC, id ASC");
        return $stmt->fetchAll();
    }

    public function activeRecords(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} WHERE status = 1 AND deleted_at IS NULL ORDER BY rank ASC, id ASC"
        );
        return $stmt->fetchAll();
    }

    public function create(array $data): int
    {
        $fields = array_intersect_key($data, array_flip($this->fillable));
        if (empty($fields)) {
            return 0;
        }
        $cols = implode(', ', array_map(fn($c) => "`{$c}`", array_keys($fields)));
        $placeholders = implode(', ', array_map(fn($c) => ":{$c}", array_keys($fields)));
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ({$cols}) VALUES ({$placeholders})");
        $stmt->execute($fields);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $fields = array_intersect_key($data, array_flip($this->fillable));
        if (empty($fields)) {
            return false;
        }
        $set = implode(', ', array_map(fn($c) => "`{$c}` = :{$c}", array_keys($fields)));
        $fields['id'] = $id;
        $stmt = $this->db->prepare("UPDATE {$this->table} SET {$set} WHERE id = :id");
        return $stmt->execute($fields);
    }

    public function softDelete(int $id): bool
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET deleted_at = NOW() WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function restore(int $id): bool
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET deleted_at = NULL WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function forceDelete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function toggleStatus(int $id): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET status = IF(status = 1, 0, 1) WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }

    public function setStatus(int $id, int $status): bool
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

    public function nextRank(): int
    {
        $stmt = $this->db->query("SELECT COALESCE(MAX(rank), 0) + 1 AS next_rank FROM {$this->table} WHERE deleted_at IS NULL");
        return (int)$stmt->fetch()['next_rank'];
    }

    public function moveUp(int $id): bool
    {
        $current = $this->findById($id);
        if (!$current || $current['rank'] <= 1) {
            return false;
        }
        $newRank = $current['rank'] - 1;
        $this->db->prepare(
            "UPDATE {$this->table} SET rank = rank + 1 WHERE rank = :rank AND deleted_at IS NULL AND id != :id"
        )->execute(['rank' => $newRank, 'id' => $id]);
        $this->db->prepare(
            "UPDATE {$this->table} SET rank = :rank WHERE id = :id"
        )->execute(['rank' => $newRank, 'id' => $id]);
        return true;
    }

    public function moveDown(int $id): bool
    {
        $current = $this->findById($id);
        if (!$current) {
            return false;
        }
        $newRank = $current['rank'] + 1;
        $this->db->prepare(
            "UPDATE {$this->table} SET rank = rank - 1 WHERE rank = :rank AND deleted_at IS NULL AND id != :id"
        )->execute(['rank' => $newRank, 'id' => $id]);
        $this->db->prepare(
            "UPDATE {$this->table} SET rank = :rank WHERE id = :id"
        )->execute(['rank' => $newRank, 'id' => $id]);
        return true;
    }

    public function bulkSetStatus(array $ids, int $status): int
    {
        if (empty($ids)) return 0;
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET status = ? WHERE id IN ({$placeholders}) AND deleted_at IS NULL"
        );
        $params = array_merge([$status], array_map('intval', $ids));
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    public function bulkSoftDelete(array $ids): int
    {
        if (empty($ids)) return 0;
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET deleted_at = NOW() WHERE id IN ({$placeholders})"
        );
        $stmt->execute(array_map('intval', $ids));
        return $stmt->rowCount();
    }

    public function search(string $term): array
    {
        if (empty($this->searchable) || trim($term) === '') {
            return [];
        }
        $conditions = [];
        $params = [];
        foreach ($this->searchable as $i => $col) {
            $key = "term{$i}";
            $conditions[] = "`{$col}` LIKE :{$key}";
            $params[$key] = '%' . $term . '%';
        }
        $where = '(' . implode(' OR ', $conditions) . ') AND deleted_at IS NULL';
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$where} ORDER BY rank ASC LIMIT 50");
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function countActive(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table} WHERE status = 1 AND deleted_at IS NULL");
        return (int)$stmt->fetch()['total'];
    }

    public function countAll(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table} WHERE deleted_at IS NULL");
        return (int)$stmt->fetch()['total'];
    }
}
