<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('greeting');
});

Route::get('/list', function () {
    return view('assetlist');
});

Route::get('/asset-management', function () {
    return view('asset-management-main');
});


