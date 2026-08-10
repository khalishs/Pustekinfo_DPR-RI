<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    const ICON_BY_KEY = [
        'apps' => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/>',
        'karyawan' => '<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/>',
        'pengguna' => '<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'spbe' => '<circle cx="12" cy="8" r="6"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>',
    ];

    public function run(): void
    {
        $stats = [
            ['label' => 'Aplikasi Terkelola', 'value' => 85, 'suffix' => '+', 'decimals' => 0, 'sort_order' => 1, 'icon_svg' => self::ICON_BY_KEY['apps']],
            ['label' => 'Karyawan Pustekinfo', 'value' => 100, 'suffix' => '', 'decimals' => 0, 'sort_order' => 2, 'icon_svg' => self::ICON_BY_KEY['karyawan']],
            ['label' => 'Pengguna Terlayani', 'value' => 12.4, 'suffix' => 'K', 'decimals' => 1, 'sort_order' => 3, 'icon_svg' => self::ICON_BY_KEY['pengguna']],
            ['label' => 'Indeks SPBE', 'value' => 3.57, 'suffix' => '', 'decimals' => 2, 'sort_order' => 4, 'icon_svg' => self::ICON_BY_KEY['spbe']],
        ];

        foreach ($stats as $stat) {
            Statistic::updateOrCreate(['sort_order' => $stat['sort_order']], $stat);
        }
    }
}
