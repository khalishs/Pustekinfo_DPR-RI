<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StelaVideo extends Model
{
    protected $fillable = ['video_type', 'video', 'youtube_url', 'link_url'];

    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        if (! $this->youtube_url) {
            return null;
        }

        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_-]{11})/', $this->youtube_url, $matches);

        return isset($matches[1]) ? 'https://www.youtube.com/embed/'.$matches[1] : $this->youtube_url;
    }
}
