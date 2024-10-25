<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'flores simples',
            'pathImage' => 'https://www.exoticasflores.cl/wp-content/uploads/2021/04/DSC0130.jpg',
            'productMobileId' => 'ANJLLSASDWD32',
            'description' => 'esto es un arreglo florar bien sencillo',
            'price' => 11500,
            'variablePrice' => false,
            'store_rut' => 65555321,
        ]);

        Product::create([
            'name' => 'flores premium',
            'pathImage' => 'https://www.memorialestienda.cl/cdn/shop/products/Arreglopeque_o3lilium_12claveles_3rosas_montonerabasedemadera_864x.jpg?v=1594070308',
            'productMobileId' => 'LLKJUKJUOY4996',
            'description' => 'esto es mas elaborado',
            'price' => 15000,
            'variablePrice' => false,
            'store_rut' => 65555321,
        ]);
    }
}
