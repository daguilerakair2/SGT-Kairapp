<?php

namespace App\Livewire\profile\store;

use LivewireUI\Modal\ModalComponent;

class EditProfile extends ModalComponent
{
    public $selectedBanner = '';

    public function changeBanner()
    {
        dd('change banner');
    }

    public function render()
    {
        $selectedStore = session('store');

        return view('livewire.profile.store.edit-profile', ['store' => $selectedStore]);
    }
}
