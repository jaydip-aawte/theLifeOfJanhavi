<?php

require_once __DIR__ . '/ContentModel.php';

class JanhaviSapkal extends ContentModel
{
    protected string $table = 'janhavi_sapkal';
    protected array $fillable = ['title', 'subtitle', 'description', 'image_path', 'icon', 'rank', 'status'];
    protected array $searchable = ['title', 'subtitle', 'description'];
}
