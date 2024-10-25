<?php

namespace Database\Seeders;

use App\Models\SubStoreProduct;
use Illuminate\Database\Seeder;

class SubStoreProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubStoreProduct::create([
            'stock' => 100,
            'price' => 11500,
            'status' => true,
            'delete' => false,
            'sub_store_id' => 1,
            'product_id' => 1,
        ]);

        SubStoreProduct::create([
            'stock' => 100,
            'price' => 11500,
            'status' => true,
            'delete' => false,
            'sub_store_id' => 2,
            'product_id' => 1,
        ]);

        SubStoreProduct::create([
            'stock' => 45,
            'price' => 15000,
            'status' => true,
            'delete' => false,
            'sub_store_id' => 1,
            'product_id' => 2,
        ]);
    }
}
