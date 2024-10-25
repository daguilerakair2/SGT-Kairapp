<?php

namespace App\Http\Controllers;

use App\Models\SubStore;

class SubStoreController extends Controller
{
    public function obtainSubStores()
    {
        $subStores = session('store')->subStores()->get();

        return response()->json([
            'subStores' => $subStores,
        ]);
    }

    public function update($id)
    {
        $subStore = SubStore::find($id);

        if ($subStore) {
            return view('sidebarScreens.storesManagement.subStore.edit', [
                'subStore' => $subStore,
            ]);
        }

        return back();
    }
}
