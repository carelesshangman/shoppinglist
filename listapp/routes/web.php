<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShoppingListController;

Route::delete('/items/{item}', [ShoppingListController::class, 'destroy'])->name('items.destroy');
Route::get('/', [ShoppingListController::class, 'index']);
Route::post('/items', [ShoppingListController::class, 'store']);
Route::patch('/items/{item}', [ShoppingListController::class, 'update'])->name('items.update');


