<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    public function create()
    {
        return view('sidebarScreens.categoryManagement.create');
    }
}
