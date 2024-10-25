<?php

namespace App\Http\Controllers\sidebar;

use App\Http\Controllers\Controller;
use App\Models\SubStore;

class SidebarController extends Controller
{
    public function ordersIndex()
    {
        // dd('desde orders index');
    }

    public function inventoryManagementIndex()
    {
        $subStoreProducts = session('selectedSubStore');
        $selectedOption = 0;
        if ($subStoreProducts) {
            $subStoreProducts = $subStoreProducts->productStore()->get();
        } else {
            $subStoreProducts = null;
        }

        return view('sidebarScreens.inventoryManagement.index', compact('subStoreProducts', 'selectedOption'));
    }

    public function inventoryManagementIndexSelected($id)
    {
        $subStoreProducts = session('selectedSubStore');
        $selectedOption = $id;
        if ($subStoreProducts) {
            $subStoreProducts = $subStoreProducts->productStore()->get();
        } else {
            $subStoreProducts = null;
        }

        return view('sidebarScreens.inventoryManagement.index', compact('subStoreProducts', 'selectedOption'));
    }

    public function manageCollaboratorsIndex()
    {
        return view('sidebarScreens.manageCollaborators.index');
    }

    public function storesManagementIndex()
    {
        return view('sidebarScreens.storesManagement.index');
    }

    public function ordersManagementStoreIndex()
    {
        $userRole = session('role');
        $selectedOption = 0;

        if ($userRole->id === 3 || $userRole->id === 4) {
            return view('sidebarScreens.ordersManagement.subStore.index');
        } else {
            return view('sidebarScreens.ordersManagement.store.index', compact('selectedOption'));
        }
    }

    public function ordersManagementStoreIndexSelected($id)
    {
        $selectedOption = $id;

        return view('sidebarScreens.ordersManagement.store.index', compact('selectedOption'));
    }

    public function ordersManagementIndex()
    {
        return view('sidebarScreens.ordersManagement.kairapp.index');
    }

    public function supportIndex()
    {
        return view('sidebarScreens.support.index');
    }

    public function profileStoreIndex()
    {
        return view('sidebarScreens.storeProfile.index');
    }

    public function ScheduleStoresIndex()
    {
        $selectedSubStore = session('selectedSubStore');

        return view('sidebarScreens.scheduleStores.index', compact('selectedSubStore'));
    }

    public function ScheduleStoresIndexSelected($id)
    {
        $selectedSubStore = SubStore::find($id);

        return view('sidebarScreens.scheduleStores.index', compact('selectedSubStore'));
    }
}
