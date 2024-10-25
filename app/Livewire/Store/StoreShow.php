<?php

namespace App\Livewire\store;

use App\Models\Store;
use Livewire\Component;

class StoreShow extends Component
{
    public function render()
    {
        $stores = Store::all();

        $stores = Store::withCount('subStores')->get();

        $stores = $stores->filter(function ($store) {
            return $store->rut !=77731223;
        });

        return view('livewire.store.store-show', compact('stores'));
    }
}
