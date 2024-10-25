<?php

namespace App\Http\Controllers\google;

use App\Http\Controllers\Controller;

class GoogleMapsController extends Controller
{
    public function loadScript()
    {
        $apiKey = config('app.google_maps_api_key');
        $scriptUrl = "https://maps.googleapis.com/maps/api/js?key={$apiKey}&libraries=places&callback=initialize";

        return response()->make(file_get_contents($scriptUrl), 200, ['Content-Type' => 'application/javascript']);
    }
}
