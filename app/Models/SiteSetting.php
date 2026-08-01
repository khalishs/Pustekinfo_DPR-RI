<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['address', 'address_en', 'phone', 'email', 'instagram_url', 'youtube_url', 'x_url', 'maps_embed_url'];
}