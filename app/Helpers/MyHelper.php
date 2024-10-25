<?php

use App\Models\Role;
use App\Models\Store;
use App\Models\SubStore;

function makeMessages()
{
    $messages = [
        'name.required' => 'El campo nombre es requerido.',
        'email.required' => 'El campo correo electrónico es requerido.',
        'password.required' => 'El campo contraaseña es requerido.',
    ];

    return $messages;
}

function searchStore($store_rut)
{
    return Store::find($store_rut);
}

function searchSubStore($subStore_id)
{
    return SubStore::find($subStore_id);
}

function searchRole($role_id)
{
    return Role::find($role_id);
}

function rutFormatter($rut, $checkDigit)
{
    $completeRut = $rut.$checkDigit;
    // Remove non-numeric characters
    $completeRut = preg_replace('/[^0-9kK]/', '', $completeRut);

    // Separate the number and the verification digit
    $number = substr($completeRut, 0, -1);
    $dv = strtoupper(substr($completeRut, -1));

    // Format the number with thousands separators and hyphen
    $number = number_format($number, 0, '', '.');

    // Concatenate the formatted number with the verification digit
    $formattedRUT = $number.'-'.$dv;

    return $formattedRUT;
}
