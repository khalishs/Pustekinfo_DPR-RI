<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $pegawai = ['ilham', 'sulthan', 'davar', 'dimas', 'alwa', 'khalis', 'kevin'];

        foreach ($pegawai as $name) {
            User::updateOrCreate(
                ['name' => $name],
                [
                    'password' => $name . '123',
                    'role' => 'pegawai',
                ]
            );
        }
    }
}
