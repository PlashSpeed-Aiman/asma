<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\AssetLendingController::class, 'index']);

Route::post('/loan/create', [App\Http\Controllers\AssetLendingController::class, 'create'])->name('loan.create');

Route::get('/list', [App\Http\Controllers\AssetLendingController::class, 'list'])->name('loan.list');

Route::get('/asset-management', [App\Http\Controllers\AssetManagementController::class, 'index'])->name('asset-management.index')->middleware('auth');

Route::post('/asset-management/create', [App\Http\Controllers\AssetManagementController::class, 'create'])->name('asset.create')->middleware('auth');

Route::get('/assets/view/partial', [App\Http\Controllers\AssetManagementController::class, 'asset_modal'])->name('asset.modal')->middleware('auth');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.post');

Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
