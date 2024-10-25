<?php

namespace Database\Seeders;

use App\Models\CharacteristiCategory;
use Illuminate\Database\Seeder;

class CharacteristiCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Floreria
        CharacteristiCategory::create([
            'characteristic_id' => 4, // Peso de la unidad
            'category_id' => 1,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 6, // Unidades por pack
            'category_id' => 1,
        ]);

        // Juguetes
        CharacteristiCategory::create([
            'characteristic_id' => 1, // Marca
            'category_id' => 2,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 2, // Fabricante
            'category_id' => 2,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 4, // Peso de la unidad
            'category_id' => 2,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 7, // Color
            'category_id' => 2,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 10, // Peso
            'category_id' => 2,
        ]);

        // Tecnologia
        CharacteristiCategory::create([
            'characteristic_id' => 1, // Marca
            'category_id' => 3,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 4, // Peso de la unidad
            'category_id' => 3,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 2, // Fabricante
            'category_id' => 3,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 8, // Material
            'category_id' => 3,
        ]);

        // Ropa
        CharacteristiCategory::create([
            'characteristic_id' => 9, // Edad
            'category_id' => 4,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 10, // Género
            'category_id' => 4,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 1, // Marca
            'category_id' => 4,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 11, // Composición
            'category_id' => 4,
        ]);

        // Chocolates
        CharacteristiCategory::create([
            'characteristic_id' => 1, // Marca
            'category_id' => 5,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 2, // Fabricante
            'category_id' => 5,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 3, // Sabor
            'category_id' => 5,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 4, // Peso de la unidad
            'category_id' => 5,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 5, // Tipo de envase
            'category_id' => 5,
        ]);

        CharacteristiCategory::create([
            'characteristic_id' => 6, // Unidades por pack
            'category_id' => 5,
        ]);
    }
}
