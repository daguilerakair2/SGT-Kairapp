<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    public function userStores()
    {
        $user = auth()->user();

        if ($user->storesUser->count()) {
            return view('user.stores', [
                'user' => $user,
            ]);
        }

        auth()->logout();

        return back()->with('message', 'Tu cuenta se encuentra deshabilitada. Contacte al administrador.');
        // dd('no hay nada');
    }

    public function createCollaborator()
    {
        return view('sidebarScreens.manageCollaborators.collaborator.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
