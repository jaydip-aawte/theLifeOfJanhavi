<?php

require_once __DIR__ . '/BaseModel.php';

class LandingPage extends BaseModel
{
    protected string $table = 'landing_page';

    public function getActive(): ?array
    {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} WHERE status = 1 ORDER BY rank ASC LIMIT 1"
        );
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function getHeroImage(): ?string
    {
        $page = $this->getActive();
        return $page['hero_image'] ?? null;
    }

    public function getBackgroundMusic(): ?string
    {
        $page = $this->getActive();
        return $page['background_music'] ?? null;
    }
}
