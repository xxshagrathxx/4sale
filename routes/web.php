<?php

use App\Http\Controllers\Api\ProviderController as ApiProviderController;
use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ProviderController::class, 'index'])->name('provider.index');
// Route::post('/clear/data', [ProviderController::class, 'clearData'])->name('provider.clear');
Route::post('/store', [ProviderController::class, 'store'])->name('provider.store');


Route::prefix('api/v1')->group(function () {
    Route::get('/users', [ApiProviderController::class, 'index'])->name('api.provider.index');
});
