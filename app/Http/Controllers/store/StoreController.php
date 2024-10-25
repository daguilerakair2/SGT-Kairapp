<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Store;
use App\Models\SubStore;
use App\Models\User;
use App\Models\UserStore;

/**
 * Controller for managing stores and stores related to users.
 */
class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id ID of the UserStore relationship to retrieve
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index($id)
    {
        $userStore = UserStore::find($id);

        if ($userStore) {
            $store = Store::find($userStore->store_rut);
            $user = User::find($userStore->user_id);

            if (auth()->user()->id === $user->id) {
                $role = Role::find($userStore->role_id);

                // Save the data in the session
                session(['store' => $store, 'role' => $role, 'user' => $user]);

                if ($role->id === 2) {
                    $store = session('store')->subStores()->first();
                    if ($store) {
                        session(['selectedSubStore' => $store]);
                    } else {
                        session(['selectedSubStore' => null]);
                    }
                } elseif ($role->id === 3) {
                    $subStore = $userStore->subStoreUser()->first();
                    $subStoreAdmin = $userStore->subStoreUser()->get();
                    if ($subStore) {
                        session(['selectedSubStore' => $subStore, 'subStoreAdmin' => $subStoreAdmin]);
                    } else {
                        session(['selectedSubStore' => null]);
                    }
                } elseif ($role->id === 4) {
                    $subStore = $userStore->subStoreUser()->first();
                    if ($subStore) {
                        session(['selectedSubStore' => $subStore, 'subStoreAdmin' => null]);
                    } else {
                        session(['selectedSubStore' => null]);
                    }
                }
                // Find the first substore of the selected store
                // Update the user's selection to true
                session()->put(['selectedStore' => true]);

                // Check if the user has a temporary password
                $user = auth()->user();
                if ($user->temporary_password) {
                    return redirect()->route('change-password.index');
                } else {
                    return redirect()->route('dashboard');
                }
            }
        }

        return redirect()->route('stores');
    }

    public function sucursalsIndex($id)
    {
        $selectedStore = Store::find($id);

        if ($selectedStore) {
            $storeSubStores = $selectedStore->subStores()->get();

            return view('sidebarScreens.storesManagement.subStore.index', [
                'selectStoreSubStores' => $storeSubStores,
                'selectedStore' => $selectedStore,
            ]);
        }

        return back();
    }

    /**
     * Get a list of stores.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtainStores()
    {
        $stores = Store::orderBy('name', 'asc')->get();

        return response()->json([
            'stores' => $stores,
        ]);
    }

    /**
     * Display the form for creating a new store.
     *
     * @return \Illuminate\View\View
     */
    public function createStore()
    {
        return view('sidebarScreens.storesManagement.store.create');
    }

    public function createSubStore($id)
    {
        $store = Store::find($id);

        return view('sidebarScreens.storesManagement.subStore.create', [
            'selectedStore' => $store,
        ]);
    }
}
