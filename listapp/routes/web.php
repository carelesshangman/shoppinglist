<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingItemController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\Auth\LoginController;

// Shopping list routes
Route::get('/lists/{share_code}', [ShoppingListController::class, 'showByShareCode'])->name('lists.showByCode');
Route::post('/lists/{share_code}/items', [ShoppingListController::class, 'store'])->name('items.store');
Route::post('/items', [ShoppingListController::class, 'store']);
Route::patch('/items/{item}', [ShoppingListController::class, 'update'])->name('items.update');
Route::delete('/items/{item}', [ShoppingListController::class, 'destroy'])->name('items.destroy');
Route::get('/items', [ShoppingListController::class, 'getItems']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/lists/{listId}/items', [ShoppingItemController::class, 'store'])->name('items.store');
Route::put('/lists/{listId}/items/{item}', [ShoppingItemController::class, 'update'])->name('items.update');
Route::delete('/lists/{listId}/items/{item}', [ShoppingItemController::class, 'destroy'])->name('items.destroy');
Route::get('/lists/{listId}', [ShoppingListController::class, 'index']);
Route::post('/lists/create', [ShoppingListController::class, 'create']);
Route::delete('/lists/{list}/delete', [ShoppingListController::class, 'deleteList']);



// Home route
Route::get('/', [HomeController::class, 'index']) -> name('home');

// Authentication (generated)
Auth::routes();
Route::get('/shopping-list', [ShoppingListController::class, 'index'])->middleware('auth');
Route::get('/shopping-list', [ShoppingListController::class, 'index'])->name('shopping-list');

