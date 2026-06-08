<?php

require_once __DIR__ . '/BaseModel.php';

class Menu extends BaseModel
{
    protected string $table = 'menus';

    public function getActiveMenus(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} WHERE status = 1 ORDER BY rank ASC"
        );
        return $stmt->fetchAll();
    }
}
