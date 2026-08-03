<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Jaringan & internet',
                'description' => 'Pengelolaan konektivitas dan infrastruktur jaringan di seluruh area kerja, memastikan seluruh unit dapat terhubung dengan stabil dan aman setiap saat.',
                'features' => ['Pemantauan jaringan 24/7', 'Manajemen bandwidth', 'Perluasan akses WiFi', '180+ titik akses aktif'],
                'cta_text' => 'Ajukan permintaan akses jaringan melalui Helpdesk IT.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Sistem informasi & Pengelolaan website',
                'description' => 'Pengembangan dan integrasi aplikasi layanan internal maupun publik, termasuk pemeliharaan portal resmi dan subdomain unit kerja.',
                'features' => ['Pengembangan aplikasi', 'Integrasi sistem', 'Pemeliharaan portal resmi', '12 aplikasi layanan aktif'],
                'cta_text' => 'Konsultasi kebutuhan sistem melalui tiket Helpdesk IT.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Helpdesk & aduan',
                'description' => 'Layanan pengaduan dan bantuan teknis untuk seluruh kendala perangkat maupun sistem, dapat diakses kapan saja melalui portal resmi.',
                'features' => ['Tiket bantuan online', 'Respons cepat', 'Pelacakan status aduan', 'Tersedia 08.00–16.00 WIB'],
                'cta_text' => 'Melalui stela.dpr.go.id',
                'sort_order' => 3,
            ],
            [
                'title' => 'Keamanan informasi',
                'description' => 'Perlindungan data dan sistem dari ancaman siber sesuai standar keamanan internasional, dengan pemantauan dan evaluasi berkelanjutan.',
                'features' => ['Sertifikasi ISO 27001:2022', 'Audit keamanan berkala', 'Manajemen insiden siber', 'Firewall & pemantauan 24/7'],
                'cta_text' => 'Laporkan insiden keamanan melalui Helpdesk IT.',
                'sort_order' => 4,
            ],
            [
                'title' => 'Data center & cloud',
                'description' => 'Penyediaan infrastruktur penyimpanan data yang aman dan andal, didukung redundansi ganda untuk menjaga kontinuitas layanan.',
                'features' => ['Penyimpanan data terenkripsi', 'Backup otomatis', 'Skalabilitas sesuai kebutuhan', 'Kapasitas 3,2 TB aktif'],
                'cta_text' => 'Ajukan kebutuhan penyimpanan melalui Helpdesk IT.',
                'sort_order' => 5,
            ],
            [
                'title' => 'Tata kelola teknologi informasi',
                'description' => 'Pemeliharaan dan pembaruan portal resmi serta subdomain unit kerja, memastikan seluruh layanan digital berjalan sesuai standar tata kelola.',
                'features' => ['Kebijakan & standar TI', 'Pengelolaan subdomain unit', 'Evaluasi kinerja berkala', 'Indeks SPBE 3,57'],
                'cta_text' => 'Konsultasi kebijakan TI melalui Helpdesk IT.',
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service);
        }
    }
}
