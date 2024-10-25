<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\StoreProduct;
use Illuminate\Http\Request;

class StoreProductController extends Controller
{
    public function changeStatus($id)
    {
        $storeProduct = StoreProduct::find($id);

        if ($storeProduct) {
            // Cambia el estado al opuesto
            $storeProduct->status = !$storeProduct->status;

            // Guarda los cambios en la base de datos
            $storeProduct->save();

            return back()->with('success', 'Estado modificado.');
        }
    }
}
