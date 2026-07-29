<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageBanner extends Model
{
    protected $fillable = ['page', 'image'];

    const PAGES = [
        'profil'    => 'Profil',
        'layanan'   => 'Layanan',
        'informasi' => 'Informasi',
        'galeri'    => 'Galeri',
        'kontak'    => 'Kontak',
    ];
}
