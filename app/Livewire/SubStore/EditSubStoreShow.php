<?php

namespace App\Livewire\subStore;

use App\Livewire\SubStore\SubstoreShowComponent;
use Livewire\Component;

class EditSubStoreShow extends Component
{
    // Tienda seleccionada
    public $selectedSubStore;

    public $name;
    public $address;
    public $commission;
    public $phone;
    public $latitude;
    public $longitude;
    public $subStoreMobileId;

    protected $rules = [
        'name' => 'required|max:255',
        'address' => 'required|max:255',
        'commission' => 'required',
        'phone' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
        'subStoreMobileId' => 'required',
    ];

    public function save()
    {
        // Validamos la informacion ingresa relacionada al a substore
        $this->validate();

        // Editar sucursal
        $updateSubStore = $this->selectedSubStore;
        $updateSubStore->name = $this->name;
        $updateSubStore->address = $this->address;
        $updateSubStore->latitude = $this->latitude;
        $updateSubStore->longitude = $this->longitude;
        $updateSubStore->commission = $this->commission;
        $updateSubStore->phone = $this->phone;
        $updateSubStore->subStoreMobileId = $this->subStoreMobileId;
        $updateSubStore->save();

        $this->dispatch('render')->to(SubstoreShowComponent::class);
        toastr()->success('La sucursal fue actualizada con éxito', 'Sucursal actualizada!');
        $this->returnStoresManagement();
    }

    public function returnStoresManagement()
    {
        $this->redirect('/stores/management');
    }

    public function replaceValues()
    {
        $this->name = $this->selectedSubStore->name;
        $this->address = $this->selectedSubStore->address;
        $this->commission = $this->selectedSubStore->commission;
        $this->phone = $this->selectedSubStore->phone;
        $this->latitude = $this->selectedSubStore->latitude;
        $this->longitude = $this->selectedSubStore->longitude;
        $this->subStoreMobileId = $this->selectedSubStore->subStoreMobileId;
    }

    public function mount($subStore)
    {
        $this->selectedSubStore = $subStore;
    }

    public function render()
    {
        $this->replaceValues();

        return view('livewire.subStore.edit-sub-store-show');
    }
}
