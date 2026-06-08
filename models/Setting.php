<?php

require_once __DIR__ . '/BaseModel.php';

class Setting extends BaseModel
{
    protected string $table = 'settings';

    public function get(string $key, string $default = ''): string
    {
        $row = $this->findByField('setting_key', $key);
        return $row['setting_value'] ?? $default;
    }

    public function set(string $key, string $value): bool
    {
        $existing = $this->findByField('setting_key', $key);

        if ($existing) {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table} SET setting_value = :value, updated_at = NOW() WHERE setting_key = :key"
            );
            return $stmt->execute(['value' => $value, 'key' => $key]);
        }

        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (setting_key, setting_value, created_at, updated_at) VALUES (:key, :value, NOW(), NOW())"
        );
        return $stmt->execute(['key' => $key, 'value' => $value]);
    }
}
