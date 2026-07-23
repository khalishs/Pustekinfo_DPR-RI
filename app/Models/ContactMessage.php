<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['nama', 'email', 'instansi', 'kategori', 'pesan', 'is_read'];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
