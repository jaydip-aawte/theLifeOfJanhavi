<?php

require_once __DIR__ . '/ContentModel.php';

class ChatpatiJanhavi extends ContentModel
{
    protected string $table = 'chatpati_janhavi';
    protected array $fillable = ['title', 'description', 'image_path', 'meme_text', 'rank', 'status'];
    protected array $searchable = ['title', 'description', 'meme_text'];
}
