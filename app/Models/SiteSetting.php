<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['address', 'address_en', 'phone', 'email', 'instagram_url', 'youtube_url', 'x_url', 'maps_embed_url', 'show_location', 'stela_video', 'stela_video_type', 'stela_youtube_url', 'stela_url'];

    protected $casts = [
        'show_location' => 'boolean',
    ];

    public function getStelaYoutubeEmbedUrlAttribute(): ?string
    {
        if (! $this->stela_youtube_url) {
            return null;
        }

        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_-]{11})/', $this->stela_youtube_url, $matches);

        return isset($matches[1]) ? 'https://www.youtube.com/embed/'.$matches[1] : $this->stela_youtube_url;
    }
}