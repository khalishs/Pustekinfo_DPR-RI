<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = ['ilham', 'sulthan', 'davar', 'dimas', 'alwa', 'khalis', 'kevin'];

        foreach ($user as $name) {
            User::updateOrCreate(
                ['name' => $name],
                [
                    'password' => Hash::make($name . '123'),
                    'role' => 'pegawai',
                    'is_admin' => true,
                ]
            );
        }

        $this->call(StatisticSeeder::class);
        $this->call(ServiceSeeder::class);
    }
 }
