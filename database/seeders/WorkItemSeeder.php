<?php

namespace Database\Seeders;

use App\Models\WorkItem;
use Illuminate\Database\Seeder;

class WorkItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // Baris atas
            ['title' => 'Pengembangan Sistem Informasi Legislasi', 'icon_key' => 'monitor', 'row_position' => 1, 'sort_order' => 1],
            ['title' => 'Pengelolaan Jaringan DPR RI', 'icon_key' => 'wifi', 'row_position' => 1, 'sort_order' => 2],
            ['title' => 'Keamanan Siber', 'icon_key' => 'shield', 'row_position' => 1, 'sort_order' => 3],
            ['title' => 'Helpdesk & Layanan TI', 'icon_key' => 'headset', 'row_position' => 1, 'sort_order' => 4],
            ['title' => 'Manajemen Data Center', 'icon_key' => 'database', 'row_position' => 1, 'sort_order' => 5],
            ['title' => 'Pengelolaan Website Resmi', 'icon_key' => 'globe', 'row_position' => 1, 'sort_order' => 6],
            ['title' => 'Layanan Video Conference', 'icon_key' => 'code', 'row_position' => 1, 'sort_order' => 7],
            ['title' => 'Digitalisasi Persidangan', 'icon_key' => 'layers', 'row_position' => 1, 'sort_order' => 8],
            ['title' => 'Pengelolaan Media Sosial Resmi', 'icon_key' => 'star', 'row_position' => 1, 'sort_order' => 9],
            ['title' => 'Backup & Recovery Data', 'icon_key' => 'cloud', 'row_position' => 1, 'sort_order' => 10],
            // Baris bawah
            ['title' => 'Pelatihan TI Pegawai', 'icon_key' => 'users', 'row_position' => 2, 'sort_order' => 11],
            ['title' => 'Integrasi Sistem E-Government', 'icon_key' => 'sliders', 'row_position' => 2, 'sort_order' => 12],
            ['title' => 'Pengembangan Aplikasi Mobile', 'icon_key' => 'briefcase', 'row_position' => 2, 'sort_order' => 13],
            ['title' => 'Pemeliharaan Perangkat Keras', 'icon_key' => 'zap', 'row_position' => 2, 'sort_order' => 14],
            ['title' => 'Manajemen Basis Data Legislasi', 'icon_key' => 'database', 'row_position' => 2, 'sort_order' => 15],
            ['title' => 'Layanan Cloud Storage', 'icon_key' => 'cloud', 'row_position' => 2, 'sort_order' => 16],
            ['title' => 'Monitoring Jaringan 24 Jam', 'icon_key' => 'chart', 'row_position' => 2, 'sort_order' => 17],
            ['title' => 'Pengelolaan Email Resmi', 'icon_key' => 'mail', 'row_position' => 2, 'sort_order' => 18],
            ['title' => 'Sistem Informasi Kepegawaian', 'icon_key' => 'lock', 'row_position' => 2, 'sort_order' => 19],
            ['title' => 'Dukungan Teknis Rapat Paripurna', 'icon_key' => 'calendar', 'row_position' => 2, 'sort_order' => 20],
        ];

        foreach ($items as $item) {
            WorkItem::updateOrCreate(
                ['title' => $item['title']],
                $item + [
                    'description' => 'Deskripsi dummy — silakan ubah lewat panel admin.',
                    'is_active' => true,
                ]
            );
        }
    }
}
