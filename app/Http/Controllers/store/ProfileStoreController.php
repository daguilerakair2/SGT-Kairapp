<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;

class ProfileStoreController extends Controller
{
    public function index()
    {
        return view('sidebarScreens.storeProfile.index');
    }
}
