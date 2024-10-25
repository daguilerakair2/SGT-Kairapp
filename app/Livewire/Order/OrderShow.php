<?php

namespace App\Livewire\order;

use App\Models\StoreOrder;
use Livewire\Component;

class OrderShow extends Component
{
    // Event listeners
    protected $listeners = ['render'];

    public function render()
    {
        $store_orders = StoreOrder::all();

        return view('livewire.order.order-show', ['storeOrders' => $store_orders]);
    }
}
