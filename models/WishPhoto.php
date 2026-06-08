<?php

require_once __DIR__ . '/ContentModel.php';

class WishPhoto extends ContentModel
{
    protected string $table = 'wish_photo';
    protected array $fillable = ['name', 'wish_text', 'wish_date', 'photo_path', 'rank', 'status'];
    protected array $searchable = ['name', 'wish_text'];
}
