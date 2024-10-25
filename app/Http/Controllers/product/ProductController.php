<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\SubStoreProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Update the form for creating a new resource.
     */
    public function update($id)
    {
        // dd($id);

        $storeProduct = SubStoreProduct::find($id);

        if ($storeProduct) {
            return view('sidebarScreens.inventoryManagement.product.edit', [
                'selectStoreProduct' => $storeProduct,
            ]);
        }

        return back();
    }

    public function create($subStore)
    {
        return view('sidebarScreens.inventoryManagement.product.create', [
            'subStore' => $subStore,
        ]);
    }
}
