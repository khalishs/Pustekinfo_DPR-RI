<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = ['kode', 'nama', 'email', 'no_tlpn', 'instansi', 'jenis_layanan', 'pesan', 'status', 'catatan_admin'];

    public const STATUSES = [
        'diajukan' => 'Diajukan',
        'diproses' => 'Diproses',
        'selesai'  => 'Selesai',
        'ditolak'  => 'Ditolak',
    ];
}
