<?php

namespace App\Livewire\order;

use App\Livewire\Order\OrderShow;
use App\Models\Store;
use App\Models\StoreOrder;
use App\Models\StoreProductOrder;
use App\Models\SubStore;
use App\Models\SubStoreProduct;
use Carbon\Carbon;
use Livewire\Component;

class CreateOrderShow extends Component
{
    // Atributes order
    public $orderMobileId;
    public $total;

    // Atributes product
    public $quantity;
    public $price;

    // Atributes search store
    public $searchStore;
    public $searchRut;

    public $subStore;
    public $subStores = [];

    // Products to selected subStore;
    public $productsSubstore = [];

    // Fields products to order
    public $products = [];

    protected $rules = [
        'orderMobileId' => 'required',
        'total' => 'required',
        'subStore' => 'required',
        'products.*.quantity' => 'required|numeric|min:1',
        'products.*.buyPrice' => 'required|numeric|min:1',
        'products.*.product' => 'required',
    ];

    public function handleSearch()
    {
        $store = Store::find($this->searchRut);

        if ($store) {
            $this->searchStore = $store;
            $this->changedSelectStore();
        } else {
            $this->searchStore = '';
            $this->subStores = [];
        }
    }

    public function changedSelectStore()
    {
        $selectedStoreRUT = $this->searchStore->rut;
        $selectedStore = Store::find($selectedStoreRUT);

        if ($selectedStore) {
            $this->subStores = [];
            $subStoresORM = $selectedStore->subStores;
            $subStores = [];

            foreach ($subStoresORM as $subStore) {
                $subStore_id = $subStore->id;
                $subStore_name = $subStore->name;
                $subStore_mobile_id = $subStore->subStoreMobileId;

                $subStores[] = [
                    'subStore_id' => $subStore_id,
                    'name' => $subStore_name,
                    'subStore_mobile_id' => $subStore_mobile_id,
                ];
            }

            $this->subStores = $subStores;
        } else {
            $this->subStores = [];
        }
    }

    public function changedSelectSubStore()
    {
        // dd($this->subStore);
        $selectedSubStoreId = $this->subStore;
        $selectedSubStore = SubStore::find($selectedSubStoreId);

        if ($selectedSubStore) {
            $this->productsSubstore = [];
            $subStoreProductsORM = $selectedSubStore->productStore;
            $products = [];

            foreach ($subStoreProductsORM as $subStoreProduct) {
                $subStoreProduct_id = $subStoreProduct->id;
                $product_name = $subStoreProduct->productDates->name;
                $productMobileId = $subStoreProduct->productDates->productMobileId;

                $products[] = [
                    'subStoreProduct_id' => $subStoreProduct_id,
                    'name' => $product_name,
                    'subStoreProductMobileId' => $productMobileId,
                ];
            }

            $this->productsSubstore = $products;
        } else {
            $this->productsSubstore = [];
        }
    }

    public function returnOrderManagement()
    {
        $this->redirect('/orders/management');
    }

    public function save()
    {
        $this->validate();

        // Find SubStore
        $subStore = SubStore::find($this->subStore);

        // Create Store Order
        $storeOrder = StoreOrder::create([
            'subTotal' => $this->total,
            'date' => Carbon::now(),
            'pending' => true,
            'orderMobile_id' => $this->orderMobileId,
            'storeMobile_id' => $subStore->subStoreMobileId,
            'sub_store_id' => $subStore->id,
        ]);

        // Create Store Product Orders
        foreach ($this->products as $product) {
            $subStoreProduct = $product['product'];
            $searchSubStoreProduct = SubStoreProduct::find($subStoreProduct);
            StoreProductOrder::create([
                'quantity' => $product['quantity'],
                'buyPrice' => $product['buyPrice'],
                'note' => $product['note'],
                'productMobile_id' => $searchSubStoreProduct->productDates->productMobileId,
                'store_order_id' => $storeOrder->id,
                'sub_store_product_id' => $product['product'],
            ]);
        }

        $this->dispatch('render')->to(OrderShow::class);
        toastr()->success('El pedido fue ingresado con éxito', 'Pedido ingresado!');
        $this->returnOrderManagement();

        // dd($storeOrder);

        // Create Store Product Orders
    }

    public function addShield()
    {
        $newKey = uniqid();
        $newShield = [
            'key' => $newKey,
            'quantity' => '',
            'buyPrice' => '',
            'note' => '',
            'product' => '',
        ];
        $this->products[$newKey] = $newShield;
    }

    public function removeShield($key)
    {
        $nowCount = count($this->products);
        if ($nowCount === 1) {
            session()->flash('ProductMessage', 'El pedido debe poseer al menos un producto.');
        } else {
            unset($this->products[$key]);
            $auxProducts = $this->products;
            $this->reset('products');
            $this->products = $auxProducts;
        }
    }

    public function mount()
    {
        $newKey = uniqid();
        $newShield = [
            'key' => $newKey,
            'quantity' => '',
            'buyPrice' => '',
            'note' => '',
        ];
        $this->products[$newKey] = $newShield;
    }

    public function render()
    {
        $store = Store::all()->where('rut', '!=', 77731223);

        return view('livewire.order.create-order-show', ['stores' => $store]);
    }
}
