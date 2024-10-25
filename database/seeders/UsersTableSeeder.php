<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           User::create([
            'name' => 'Kairapp',
            'email' => 'kairapp@kairapp.com',
            'password' => bcrypt('kairapp2023'),
            'temporary_password' => false,
        ]);
    }
}
