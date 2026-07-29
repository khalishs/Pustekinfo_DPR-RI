<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            ['key' => 'apps', 'label' => 'Aplikasi Terkelola', 'value' => 85, 'suffix' => '+', 'decimals' => 0, 'sort_order' => 1],
            ['key' => 'karyawan', 'label' => 'Karyawan Pustekinfo', 'value' => 100, 'suffix' => '', 'decimals' => 0, 'sort_order' => 2],
            ['key' => 'pengguna', 'label' => 'Pengguna Terlayani', 'value' => 12.4, 'suffix' => 'K', 'decimals' => 1, 'sort_order' => 3],
            ['key' => 'spbe', 'label' => 'Indeks SPBE', 'value' => 3.57, 'suffix' => '', 'decimals' => 2, 'sort_order' => 4],
        ];

        foreach ($stats as $stat) {
            Statistic::updateOrCreate(['key' => $stat['key']], $stat);
        }
    }
}
