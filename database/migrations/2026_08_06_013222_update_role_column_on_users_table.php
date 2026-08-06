<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Kolom "role" sudah ada sejak awal (default lama "pegawai", tidak pernah
        // dipakai di kode). Di sini kita standarkan nilainya jadi dua peran:
        // "super_admin" (kontrol penuh, termasuk kelola akun & password User lain)
        // dan "user" (operator CMS biasa, tidak bisa ubah password sendiri).
        DB::table('users')->where('is_admin', true)->update(['role' => 'super_admin']);
        DB::table('users')->where('is_admin', false)->orWhereNull('is_admin')->update(['role' => 'user']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->update(['role' => 'pegawai']);
    }
};
