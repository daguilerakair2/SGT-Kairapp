<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regionsChile = [
            ['name' => 'Región de Tarapacá', 'country_id' => 1],
            ['name' => 'Región de Antofagasta', 'country_id' => 1],
            ['name' => 'Región de Atacama', 'country_id' => 1],
            ['name' => 'Región de Coquimbo', 'country_id' => 1],
            ['name' => 'Región de Valparaíso', 'country_id' => 1],
            ['name' => 'Región Metropolitana de Santiago', 'country_id' => 1],
            ['name' => 'Región del Libertador General Bernardo O\'Higgins', 'country_id' => 1],
            ['name' => 'Región del Maule', 'country_id' => 1],
            ['name' => 'Región de Ñuble', 'country_id' => 1],
            ['name' => 'Región del Biobío', 'country_id' => 1],
            ['name' => 'Región de La Araucanía', 'country_id' => 1],
            ['name' => 'Región de Los Ríos', 'country_id' => 1],
            ['name' => 'Región de Los Lagos', 'country_id' => 1],
            ['name' => 'Región de Aysén del General Carlos Ibáñez del Campo', 'country_id' => 1],
            ['name' => 'Región de Magallanes y de la Antártica Chilena', 'country_id' => 1],
            ['name' => 'Región de Arica y Parinacota', 'country_id' => 1],
        ];

        State::insert($regionsChile);
    }
}
