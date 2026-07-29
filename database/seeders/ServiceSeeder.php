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
                'icon_svg' => '<path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/>',
                'sort_order' => 1,
            ],
            [
                'title' => 'Sistem informasi & Pengelolaan website',
                'description' => 'Pengembangan dan integrasi aplikasi layanan internal maupun publik, termasuk pemeliharaan portal resmi dan subdomain unit kerja.',
                'features' => ['Pengembangan aplikasi', 'Integrasi sistem', 'Pemeliharaan portal resmi', '12 aplikasi layanan aktif'],
                'cta_text' => 'Konsultasi kebutuhan sistem melalui tiket Helpdesk IT.',
                'icon_svg' => '<rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>',
                'sort_order' => 2,
            ],
            [
                'title' => 'Helpdesk & aduan',
                'description' => 'Layanan pengaduan dan bantuan teknis untuk seluruh kendala perangkat maupun sistem, dapat diakses kapan saja melalui portal resmi.',
                'features' => ['Tiket bantuan online', 'Respons cepat', 'Pelacakan status aduan', 'Tersedia 08.00–16.00 WIB'],
                'cta_text' => 'Melalui stela.dpr.go.id',
                'icon_svg' => '<path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>',
                'sort_order' => 3,
            ],
            [
                'title' => 'Keamanan informasi',
                'description' => 'Perlindungan data dan sistem dari ancaman siber sesuai standar keamanan internasional, dengan pemantauan dan evaluasi berkelanjutan.',
                'features' => ['Sertifikasi ISO 27001:2022', 'Audit keamanan berkala', 'Manajemen insiden siber', 'Firewall & pemantauan 24/7'],
                'cta_text' => 'Laporkan insiden keamanan melalui Helpdesk IT.',
                'icon_svg' => '<path d="M12 2 4 5v6c0 5.2 3.4 9.9 8 11 4.6-1.1 8-5.8 8-11V5l-8-3z"/>',
                'sort_order' => 4,
            ],
            [
                'title' => 'Data center & cloud',
                'description' => 'Penyediaan infrastruktur penyimpanan data yang aman dan andal, didukung redundansi ganda untuk menjaga kontinuitas layanan.',
                'features' => ['Penyimpanan data terenkripsi', 'Backup otomatis', 'Skalabilitas sesuai kebutuhan', 'Kapasitas 3,2 TB aktif'],
                'cta_text' => 'Ajukan kebutuhan penyimpanan melalui Helpdesk IT.',
                'icon_svg' => '<rect x="2" y="3" width="20" height="8" rx="2" ry="2"/><rect x="2" y="13" width="20" height="8" rx="2" ry="2"/><line x1="6" y1="7" x2="6.01" y2="7"/><line x1="6" y1="17" x2="6.01" y2="17"/>',
                'sort_order' => 5,
            ],
            [
                'title' => 'Tata kelola teknologi informasi',
                'description' => 'Pemeliharaan dan pembaruan portal resmi serta subdomain unit kerja, memastikan seluruh layanan digital berjalan sesuai standar tata kelola.',
                'features' => ['Kebijakan & standar TI', 'Pengelolaan subdomain unit', 'Evaluasi kinerja berkala', 'Indeks SPBE 3,57'],
                'cta_text' => 'Konsultasi kebijakan TI melalui Helpdesk IT.',
                'icon_svg' => '<circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><path d="M5 17v-2a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><circle cx="12" cy="19" r="2"/>',
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service);
        }
    }
}
