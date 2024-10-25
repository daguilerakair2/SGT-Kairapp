<?php

namespace App\Livewire\category;

use App\Livewire\Product\ProductsShow;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\CharacteristiCategory;
use Livewire\Component;

class CreateCategoryShowComponent extends Component
{
    public $name;

    public $characteristics = [];

    public $rules = [
        'name' => 'required',
        'characteristics.*.name' => 'required',
    ];

    public function save()
    {
        $this->validate();

        // dd($this->characteristics, $this->name);

        // Crear Categoria
        $newCategory = Category::create([
            'name' => $this->name,
        ]);

        // dd($this->characteristics['6551cc71d13a3']);

        // Crear las Caracteristicas y linkear con la categoria
        foreach ($this->characteristics as $key => $characteristic) {
            // Crear la caracteristica
            $newCharacterictic = Characteristic::create([
                'name' => $characteristic['name'],
            ]);
            // Crear el CharacteristicCategory
            CharacteristiCategory::create([
                'characteristic_id' => $newCharacterictic->id,
                'category_id' => $newCategory->id,
            ]);
        }

        $this->dispatch('render')->to(ProductsShow::class);
        toastr()->success('La categoría fue creada con éxito', 'Categoría creada!');
        $this->returnInventory();
    }

    public function addShield()
    {
        $newKey = uniqid();
        $newShield = [
            'key' => $newKey,
            'name' => '',
        ];
        $this->characteristics[$newKey] = $newShield;
    }

    public function removeShield($key)
    {
        $nowCount = count($this->characteristics);
        if ($nowCount === 1) {
            session()->flash('categoryMessage', 'La categoría debe poseer al menos una característica.');
        } else {
            unset($this->characteristics[$key]);
            $auxCharacteristics = $this->characteristics;
            $this->reset('characteristics');
            $this->characteristics = $auxCharacteristics;
        }
    }

    public function returnInventory()
    {
        $this->redirect('/inventory');
    }

    public function mount()
    {
        $newKey = uniqid();
        $newShield = [
            'key' => $newKey,
            'name' => '',
        ];
        $this->characteristics[$newKey] = $newShield;
    }

    public function render()
    {
        return view('livewire.category.create-category-show-component');
    }
}
