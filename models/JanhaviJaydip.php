<?php

require_once __DIR__ . '/ContentModel.php';

class JanhaviJaydip extends ContentModel
{
    protected string $table = 'janhavi_jaydip';
    protected array $fillable = ['title', 'subtitle', 'description', 'image_path', 'youtube_embed_url', 'content_type', 'rank', 'status'];
    protected array $searchable = ['title', 'subtitle', 'description'];
}
