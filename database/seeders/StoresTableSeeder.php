<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'rut' => 77731223,
            'checkDigit' => '5',
            'companyName' => 'Giftify Spa',
            'fantasyName' => 'Kairapp',
            'description' => 'Tienda de regalos',
            'pathProfile' => 'https://www.vegamonumental.cl/wp-content/uploads/2019/07/IMG_20190719_115942-600x400.jpg',
            'pathBackground' => 'https://previews.123rf.com/images/rickdeacon/rickdeacon1607/rickdeacon160700264/60279698-un-tiro-de-una-tienda-de-chocolates-spr%C3%BCngli.jpg',
            'itinerant' => false,
            'custom' => false,
            'status' => true,
        ]);
    }
}
