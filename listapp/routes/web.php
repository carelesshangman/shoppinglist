<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\Auth\LoginController;

// Shopping list routes
Route::post('/items', [ShoppingListController::class, 'store']);
Route::patch('/items/{item}', [ShoppingListController::class, 'update'])->name('items.update');
Route::delete('/items/{item}', [ShoppingListController::class, 'destroy'])->name('items.destroy');
Route::get('/items', [ShoppingListController::class, 'getItems']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Home route
Route::get('/', [HomeController::class, 'index']) -> name('home');

// Authentication (generated)
Auth::routes();
Route::get('/shopping-list', [ShoppingListController::class, 'index'])->middleware('auth');
Route::get('/shopping-list', [ShoppingListController::class, 'index'])->name('shopping-list');

