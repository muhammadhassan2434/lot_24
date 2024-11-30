<?php

use App\Http\Controllers\Authentication\API\AuthController;
use App\Http\Controllers\API\Seller\ProductController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('signup',[AuthController::class,'signup']);
Route::post('login',[AuthController::class,'login'])->name('api.login');

Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

Route::get('/category', [ProductController::class, 'category']);
Route::get('/subcategory', [ProductController::class, 'subcategory']);
Route::get('/brand', [ProductController::class, 'brand']);
Route::get('/country', [ProductController::class, 'country']);


// Route::apiResource('products', ProductController::class);

Route::get('/get-product',[ProductController::class,'index']);
Route::post('/store-product',[ProductController::class,'store']);
Route::get('/edit-product/{id}',[ProductController::class,'edit']);
Route::post('/update-product',[ProductController::class,'update']);
// Route::get('/get-product',[ProductController::class,'index']);
