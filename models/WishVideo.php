<?php

require_once __DIR__ . '/ContentModel.php';

class WishVideo extends ContentModel
{
    protected string $table = 'wish_video';
    protected array $fillable = ['name', 'wish_text', 'youtube_url', 'youtube_embed_url', 'rank', 'status'];
    protected array $searchable = ['name', 'wish_text'];

    public static function toEmbedUrl(string $url): string
    {
        $url = trim($url);
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([A-Za-z0-9_-]{11})/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }
        return $url;
    }
}
