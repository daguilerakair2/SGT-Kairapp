<?php

namespace App\Livewire\order;

use App\Models\StoreOrder;
use App\Models\StoreProductOrder;
use LivewireUI\Modal\ModalComponent;

class DetailOrder extends ModalComponent
{
    public $order_id;

    public function render()
    {
        $order = StoreOrder::find($this->order_id);
        $orderProducts = StoreProductOrder::where('store_order_id', $this->order_id)->get();

        return view('livewire.order.detail-order', ['orderProducts' => $orderProducts, 'order' => $order]);
    }
}
