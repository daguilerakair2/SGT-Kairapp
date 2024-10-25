<?php

namespace Database\Seeders;

use App\Models\SubStore;
use Illuminate\Database\Seeder;

class SubStoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Floreria del Norte Substores
        SubStore::create([
            'name' => 'Floreria Norte Pedro Aguirre Cerda',
            'address' => 'Matta 4022',
            'latitude' => '-74.4776',
            'longitude' => '-45.3333',
            'phone' => 56987345632,
            'status' => true,
            'commission' => 10,
            'subStoreMobileId' => 'AYOcf9vm1wuaikAbd5',
            'city_id' => 7,
            'store_rut' => 65555321,
        ]);

        // Floreria del Norte Substores
        SubStore::create([
            'name' => 'Floreria Norte Angamos',
            'address' => 'Angamos 5831',
            'latitude' => '-40.4776',
            'longitude' => '-32.3333',
            'phone' => 56987345632,
            'status' => true,
            'commission' => 14,
            'subStoreMobileId' => 'XCKcf9vm1wuaikAbd5',
            'city_id' => 7,
            'store_rut' => 65555321,
        ]);

        // Chocolates Juanita SubStores
        SubStore::create([
            'name' => 'Chocolates Juanita Angamos Sector Sur',
            'address' => 'Angamos 5945',
            'latitude' => '-35.4222',
            'longitude' => '-32.1233',
            'phone' => 56965239076,
            'status' => true,
            'commission' => 11,
            'subStoreMobileId' => 'puniQK9fF1xrftatAbc1',
            'city_id' => 7,
            'store_rut' => 77584357,
        ]);

        SubStore::create([
            'name' => 'Chocolates Juanita Bonilla Sector Norte',
            'address' => 'Angamos 5945',
            'latitude' => '-60.4222',
            'longitude' => '-42.1233',
            'phone' => 56976432188,
            'status' => true,
            'commission' => 7,
            'subStoreMobileId' => 'komiQN9Aa1stfeatDef1',
            'city_id' => 7,
            'store_rut' => 77584357,
        ]);
    }
}
