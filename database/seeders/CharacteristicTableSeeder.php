<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use Illuminate\Database\Seeder;

class CharacteristicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // id.1
        Characteristic::create([
            'name' => 'Marca',
        ]);

        // id.2
        Characteristic::create([
            'name' => 'Fabricante',
        ]);

        // id.3
        Characteristic::create([
            'name' => 'Sabor',
        ]);

        // id.4
        Characteristic::create([
            'name' => 'Peso de la unidad',
        ]);

        // id.5
        Characteristic::create([
            'name' => 'Tipo de envase',
        ]);

        // id.6
        Characteristic::create([
            'name' => 'Unidades por pack',
        ]);

        // id.7
        Characteristic::create([
            'name' => 'Color',
        ]);

        // id.8
        Characteristic::create([
            'name' => 'Material',
        ]);

        // id.9
        Characteristic::create([
            'name' => 'Edad',
        ]);

        // id.10
        Characteristic::create([
            'name' => 'Genero',
        ]);

        // id.11
        Characteristic::create([
            'name' => 'Composición',
        ]);
    }
}
