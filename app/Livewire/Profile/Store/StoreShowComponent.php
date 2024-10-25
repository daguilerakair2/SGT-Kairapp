<?php

namespace App\Livewire\Profile\Store;

use Livewire\Component;

class StoreShowComponent extends Component
{
    // Event listeners
    protected $listeners = ['render'];

    public function render()
    {
        return view('livewire.profile.store.store-show-component');
    }
}
