<?php

require_once __DIR__ . '/ContentModel.php';

class EmotionalQuote extends ContentModel
{
    protected string $table = 'emotional_quotes';
    protected array $fillable = ['quote_text', 'author_text', 'rank', 'status'];
    protected array $searchable = ['quote_text', 'author_text'];

    /**
     * A single random active quote (or null when none exist).
     */
    public function random(): ?array
    {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table}
             WHERE status = 1 AND deleted_at IS NULL
             ORDER BY RAND() LIMIT 1"
        );
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
