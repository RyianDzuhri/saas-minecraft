<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('/servers', [ServerController::class, 'index'])->name('servers.index');
    Route::post('/servers', [ServerController::class, 'store'])->name('servers.store');
    Route::delete('/servers/{server}', [ServerController::class, 'destroy'])->name('servers.destroy');

    Route::get('/pay/{server}', [PaymentController::class, 'create'])
        ->name('pay.create');

});

Route::post('/webhook/xendit', [PaymentController::class, 'webhook']);

require __DIR__.'/settings.php';
