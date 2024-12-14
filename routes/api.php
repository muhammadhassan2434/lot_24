<?php

use App\Http\Controllers\admin\SubscriptionController;
use App\Http\Controllers\API\contact\ContactController;
use App\Http\Controllers\API\register\AccountsController;
use App\Http\Controllers\Authentication\API\AuthController;
use App\Http\Controllers\API\Seller\ProductController;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('signup',[AuthController::class,'signup']);
Route::post('login',[AuthController::class,'login'])->name('api.login');

Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

Route::get('/category', [ProductController::class, 'category']);
Route::get('/subcategory/{id}', [ProductController::class, 'subcategory']);
Route::get('/brand', [ProductController::class, 'brand']);
Route::get('/country', [ProductController::class, 'country']);


// Route::apiResource('products', ProductController::class);

Route::get('/get-product',[ProductController::class,'index']);
Route::get('/edit-product/{id}',[ProductController::class,'editProduct']);
Route::post('/update-product/{id}',[ProductController::class,'update']);
Route::get('/get-product/detail/{id}',[ProductController::class,'show']);
// Route::get('/get-product',[ProductController::class,'index']);

Route::delete('/delete-product/{id}',[ProductController::class,'destroy']);
// Route::get('/get-product',[ProductController::class,'index']);


Route::get('/show-subscription',[SubscriptionController::class,'showsubscription']);


//api to get offers product for home page
Route::get('/week-best-offer', [ProductController::class, 'showweekofferproduct']);
Route::get('/recent-add-products', [ProductController::class, 'showrecentlyaddedproduct']);
Route::get('/most-populer-products', [ProductController::class, 'showmostpopularproduct']);

Route::resource('/accounts',AccountsController::class);
Route::post('/store-account',[AccountsController::class,'storeAccounts']);

Route::post('/buyer-login',[AccountsController::class,'login']);
Route::post('/seller-login',[AccountsController::class,'sellerLogin']);


Route::post('/store-product',[ProductController::class,'store']);

Route::resource('/accounts',AccountsController::class);
Route::post('/store-account',[AccountsController::class,'storeAccounts']);
Route::post('/store-invoice',[AccountsController::class,'storeInvoice']);
Route::post('/store-contact', [ContactController::class, 'store']);
Route::get('/sellerproduct/{id}',[ProductController::class,'sellerproducts']);


// chat apis
Route::get('/chats', [ChatController::class, 'getMessages']);
Route::post('/chats', [ChatController::class, 'sendMessage']);