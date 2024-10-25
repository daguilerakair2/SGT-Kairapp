<?php

namespace App\Livewire\product;

use App\Jobs\SendProductUpdateStatusToMobile;
use App\Models\SubStore;
use App\Models\SubStoreProduct;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsShow extends Component
{
    use WithPagination;

    public $subStores = [];
    public $selectedOptionV;
    public $subStoreProducts = [];

    // Variables to hold data for editing a product
    public $editingProductID;
    public $editingProductPrice;
    public $editingProductStock;

    // Event listeners for Livewire components
    protected $listeners = ['render', 'delete'];

    // The current selected store product
    public SubStoreProduct $currentStoreProduct;
    public $selectedOption;

    /**
     * Handle changes in the selected sub-store and update products accordingly.
     */
    public function handleSelectChange()
    {
        $findSubStoreProducts = SubStore::find($this->selectedOption);
        $findProducts = $findSubStoreProducts->productStore()->get();

        // asignamos los productos segun la sucursal seleccionada
        $this->subStoreProducts = $findProducts;

        // $this->dispatch('render', selectedOption: $this->selectedOption)->to(ProductsShow::class);
        return redirect()->route('inventory-selected.index', ['id' => $this->selectedOption]);
    }

    /**
     * Receive updates for a store product's status.
     *
     * @param int $id the ID of the store product to update
     */
    public function receiveUpdates($id)
    {
        $storeProduct = SubStoreProduct::findOrFail($id);

        if ($storeProduct) {
            // Toggle the status
            $storeProduct->status = !$storeProduct->status;
            // Save the changes to the database
            $storeProduct->save();

            $status = $storeProduct->status ? true : false;

            // Send the updated status to the mobile app
            SendProductUpdateStatusToMobile::dispatch($storeProduct->productDates, $status);
        }
    }

    /**
     * Edit a store product.
     *
     * @param int $id the ID of the store product to edit
     */
    public function edit($id)
    {
        $selectProduct = SubStoreProduct::find($id)->first();
        $this->dispatch('create-product-show', selectProduct: $selectProduct);
    }

    /**
     * Delete a store product.
     *
     * @param int $id the ID of the store product to delete
     */
    public function delete($id)
    {
        // dd($id);
        $storeProduct = SubStoreProduct::findOrFail($id);

        if ($storeProduct) {
            // Toggle the delete status
            $storeProduct->delete = !$storeProduct->delete;
            // Save the changes to the database
            $storeProduct->save();
        }
    }

    public function mount()
    {
        $store = session('store');
        $roleAdmin = session('role');
        if ($roleAdmin->id === 2) {
            $array = $store->subStores()->get();
            $this->subStores = $array;

            // Asigna un valor inicial a $selectedOption
            // dd($this->subStores);
            $this->selectedOption = $this->subStores[0]->id; // Asigna el valor inicial apropiado

            $findSubStoreProducts = SubStore::find($this->selectedOption);
            $findProducts = $findSubStoreProducts->productStore()->get();

            // asignamos los productos segun la sucursal seleccionada
            $this->subStoreProducts = $findProducts;
        } elseif ($roleAdmin->id === 3) {
            $selectedSubStore = session('selectedSubStore');
            $subStore = SubStore::where('id', $selectedSubStore->id)->get();
            $this->subStores = $subStore;
            $this->selectedOption = $this->subStores[0]->id; // Asigna el valor inicial apropiado

            $findSubStoreProducts = SubStore::find($this->selectedOption);
            $findProducts = $findSubStoreProducts->productStore()->get();

            // asignamos los productos segun la sucursal seleccionada
            $this->subStoreProducts = $findProducts;
        }
    }

    /**
     * Render the Livewire component.
     */
    public function render()
    {
        if ($this->selectedOptionV === 0) {
            // Se obtiene el tipo de administrador
            $roleAdmin = session('role');
            if ($roleAdmin->id === 2) {
                // Se obtiene la informacion de la tienda seleccionada
                $store = session('store');
                // Se obtienen todas las sucursales de la tienda
                $arraySubStores = $store->subStores()->get();

                // Se asignan estas sucursales a la variable respectiva manejada por el componente
                $this->subStores = $arraySubStores;

                $findSubStoreProducts = SubStore::find($this->selectedOption);
                $findProducts = $findSubStoreProducts->productStore()->get();

                $subStoreProducts = $findSubStoreProducts->productStoreTest();

                // asignamos los productos segun la sucursal seleccionada
                $this->subStoreProducts = $findProducts;

                return view('livewire.product.products-show', ['subStores' => $this->subStores, 'subStoreProducts' => $subStoreProducts]);
            } elseif ($roleAdmin->id === 3) {
                $store = session('store');
                $selectedSubStore = session('selectedSubStore');
                $findProducts = $selectedSubStore->productStore()->get();
                $subStoreProducts = $selectedSubStore->productStore()->paginate(5);
                $this->subStores = session('subStoreAdmin');
                // asignamos los productos segun la sucursal seleccionada
                $this->subStoreProducts = $findProducts;

                return view('livewire.product.products-show', ['subStores' => $this->subStores, 'subStoreProducts' => $subStoreProducts]);
            }
        } else {
            $this->selectedOption = $this->selectedOptionV;
            $store = session('store');
            $array = $store->subStores()->get();
            $this->subStores = $array;

            $findSubStoreProducts = SubStore::find($this->selectedOptionV);
            $findProducts = $findSubStoreProducts->productStore()->get();

            // asignamos los productos segun la sucursal seleccionada
            $this->subStoreProducts = $findProducts;

            return view('livewire.product.products-show', ['subStores' => $this->subStores, 'subStoreProducts' => $this->subStoreProducts]);
        }
    }
}
