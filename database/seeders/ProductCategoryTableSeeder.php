<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'product_id' => 1,
            'category_id' => 1,
        ]);

        ProductCategory::create([
            'product_id' => 2,
            'category_id' => 1,
        ]);
    }
}
