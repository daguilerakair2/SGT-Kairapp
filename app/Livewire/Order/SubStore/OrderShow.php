<?php

namespace App\Livewire\Order\SubStore;

use App\Models\StoreOrder;
use Livewire\Component;

class OrderShow extends Component
{
    protected $listeners = ['render', 'editOrder'];

    public function returnOrder()
    {
        $this->redirect('/orders/subStore/management');
    }

    public function editOrder($id)
    {
        // dd($id);

        $order = StoreOrder::find($id);

        $order->update([
            'storeMobile_id' => '1',
        ]);
        toastr()->success('El pedido fue marcado como entregado!', 'Pedido entregado');
        $this->returnOrder();
        // dd($id);
    }

    public function render()
    {
        $orders = StoreOrder::where('sub_store_id', session('selectedSubStore')->id)->get();

        return view('livewire.order.sub-store.order-show', ['orders' => $orders]);
    }
}
