<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseController;

Route::get('/', [WarehouseController::class, 'index'])->name('warehouse.index');
Route::get('/warehouse/{id}', [WarehouseController::class, 'show'])->name('warehouse.show');
Route::post('/warehouse/update-inline', [WarehouseController::class, 'updateInline'])->name('warehouse.updateInline');
