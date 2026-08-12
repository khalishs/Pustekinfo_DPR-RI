<?php

namespace App\Support;

class WorkItemIcons
{
    /**
     * Fixed, trusted icon library. Admin picks a key from this list — the raw
     * SVG markup itself is never accepted as free-form input.
     */
    private const ICONS = [
        'wifi' => ['label' => 'Wifi / Jaringan', 'paths' => '<path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/>'],
        'monitor' => ['label' => 'Monitor / Sistem', 'paths' => '<rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>'],
        'headset' => ['label' => 'Helpdesk / Bantuan', 'paths' => '<path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>'],
        'shield' => ['label' => 'Perisai / Keamanan', 'paths' => '<path d="M12 2 4 5v6c0 5.2 3.4 9.9 8 11 4.6-1.1 8-5.8 8-11V5l-8-3z"/>'],
        'cloud' => ['label' => 'Cloud', 'paths' => '<path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/>'],
        'globe' => ['label' => 'Globe / Website', 'paths' => '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>'],
        'database' => ['label' => 'Database', 'paths' => '<path d="M4 4c0-1.1 3.6-2 8-2s8 .9 8 2-3.6 2-8 2-8-.9-8-2z"/><path d="M4 4v6c0 1.1 3.6 2 8 2s8-.9 8-2V4"/><path d="M4 10v6c0 1.1 3.6 2 8 2s8-.9 8-2v-6"/><path d="M4 16v4c0 1.1 3.6 2 8 2s8-.9 8-2v-4"/>'],
        'sliders' => ['label' => 'Pengaturan', 'paths' => '<line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/>'],
        'users' => ['label' => 'Pengguna / Tim', 'paths' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
        'chart' => ['label' => 'Statistik', 'paths' => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>'],
        'lock' => ['label' => 'Kunci / Keamanan Data', 'paths' => '<rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>'],
        'mail' => ['label' => 'Surat / Email', 'paths' => '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22 6 12 13 2 6"/>'],
        'calendar' => ['label' => 'Kalender', 'paths' => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>'],
        'layers' => ['label' => 'Lapisan / Integrasi', 'paths' => '<polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>'],
        'zap' => ['label' => 'Kecepatan / Performa', 'paths' => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>'],
        'code' => ['label' => 'Kode / Pengembangan', 'paths' => '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>'],
        'star' => ['label' => 'Unggulan', 'paths' => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>'],
        'briefcase' => ['label' => 'Layanan / Kerja', 'paths' => '<rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>'],
    ];

    public static function all(): array
    {
        return self::ICONS;
    }

    public static function keys(): array
    {
        return array_keys(self::ICONS);
    }

    public static function svg(?string $key): string
    {
        $paths = self::ICONS[$key]['paths'] ?? self::ICONS['layers']['paths'];

        return '<svg viewBox="0 0 24 24">' . $paths . '</svg>';
    }
}
