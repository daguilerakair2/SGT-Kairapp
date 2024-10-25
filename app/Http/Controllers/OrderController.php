<?php

namespace App\Http\Controllers;

class OrderController extends Controller
{
    public function createOrder()
    {
        return view('sidebarScreens.ordersManagement.kairapp.order.create');
    }
}
