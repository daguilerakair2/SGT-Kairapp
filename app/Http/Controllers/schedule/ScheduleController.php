<?php

namespace App\Http\Controllers\schedule;

use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function create($subStore)
    {
        return view('sidebarScreens.scheduleStores.create', [
            'subStore' => $subStore,
        ]);
    }
}
