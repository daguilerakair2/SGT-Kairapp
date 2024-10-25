<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Administrador Kairapp',
        ]);

        Role::create([
            'name' => 'Administrador Tienda',
        ]);

        Role::create([
            'name' => 'Administrador Sucursal',
        ]);

        Role::create([
            'name' => 'Colaborador',
        ]);
    }
}
