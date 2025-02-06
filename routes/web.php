<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\AssetLendingController::class, 'index']);

Route::post('loan/create', [App\Http\Controllers\AssetLendingController::class, 'create'])->name('loan.create');

Route::get('/list', function () {
    return view('assetlist');
});

Route::get('/asset-management', function () {
    return view('asset-management-main');
});


