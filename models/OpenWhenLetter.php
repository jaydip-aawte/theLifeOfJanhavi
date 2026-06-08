<?php

require_once __DIR__ . '/ContentModel.php';

class OpenWhenLetter extends ContentModel
{
    protected string $table = 'open_when_letters';
    protected array $fillable = ['title', 'category', 'letter_content', 'envelope_color', 'rank', 'status'];
    protected array $searchable = ['title', 'letter_content'];

    /**
     * Active letters for one or more categories, ordered by rank.
     * @param string[] $categories
     */
    public function byCategories(array $categories): array
    {
        if (empty($categories)) {
            return [];
        }
        $placeholders = implode(',', array_fill(0, count($categories), '?'));
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table}
             WHERE status = 1 AND deleted_at IS NULL AND category IN ({$placeholders})
             ORDER BY rank ASC, id ASC"
        );
        $stmt->execute($categories);
        return $stmt->fetchAll();
    }
}
