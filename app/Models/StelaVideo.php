<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StelaVideo extends Model
{
    protected $fillable = ['video_url', 'link_url'];

    /**
     * URL yang aman ditaruh di <iframe> kalau providernya dikenali (YouTube,
     * Google Drive). Provider lain (Terabox, dll) umumnya tidak mengizinkan
     * embed lewat iframe, jadi null — tampilan publik cukup tampilkan tombol
     * buka link videonya di tab baru.
     */
    public function getEmbedUrlAttribute(): ?string
    {
        if (! $this->video_url) {
            return null;
        }

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_-]{11})/', $this->video_url, $matches)) {
            // autoplay=1 hanya diizinkan browser kalau videonya dibisukan (mute=1) —
            // pengunjung tetap bisa menyalakan suara lewat kontrol player YouTube-nya.
            return 'https://www.youtube.com/embed/'.$matches[1].'?autoplay=1&mute=1&playsinline=1';
        }

        if (preg_match('/drive\.google\.com\/file\/d\/([A-Za-z0-9_-]+)/', $this->video_url, $matches)
            || preg_match('/drive\.google\.com\/open\?id=([A-Za-z0-9_-]+)/', $this->video_url, $matches)) {
            return 'https://drive.google.com/file/d/'.$matches[1].'/preview';
        }

        return null;
    }

    public function getVideoSourceLabelAttribute(): string
    {
        if (! $this->video_url) {
            return 'Belum ada';
        }

        return match (true) {
            str_contains($this->video_url, 'youtube.com') || str_contains($this->video_url, 'youtu.be') => 'YouTube',
            str_contains($this->video_url, 'drive.google.com') => 'Google Drive',
            str_contains($this->video_url, 'terabox.com') => 'Terabox',
            default => 'Link video',
        };
    }
}
