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

        foreach ($user as $index => $name) {
            User::updateOrCreate(
                ['name' => $name],
                [
                    'email' => $name . '@pustekinfo.dpr.go.id',
                    'password' => Hash::make($name . '123'),
                    'role' => $index === 0 ? User::ROLE_SUPER_ADMIN : User::ROLE_USER,
                    'is_admin' => true,
                ]
            );
        }

        $this->call(StatisticSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(WorkItemSeeder::class);
    }
 }
