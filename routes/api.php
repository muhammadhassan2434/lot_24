<?php

use App\Http\Controllers\admin\SubscriptionController;
use App\Http\Controllers\API\contact\ContactController;
use App\Http\Controllers\API\register\AccountsController;
use App\Http\Controllers\Authentication\API\AuthController;
use App\Http\Controllers\API\Seller\ProductController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\buyerAuthenticate;
use App\Http\Middleware\sellerAuthenticate;
use Illuminate\Http\Request;
use App\Http\Controllers\TopbarController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PopularsearchController  ;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;



Broadcast::channel('chat-channel', function ($user) {
    return true;
});

Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login'])->name('api.login');

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/category', [ProductController::class, 'category']);
Route::get('/subcategory/{id}', [ProductController::class, 'subcategory']);
Route::get('/brand', [ProductController::class, 'brand']);
Route::get('/country', [ProductController::class, 'country']);


// Route::apiResource('products', ProductController::class);

Route::get('/get-product', [ProductController::class, 'index']);
Route::get('/edit-product/{id}', [ProductController::class, 'editProduct']);
Route::post('/update-product/{id}', [ProductController::class, 'update']);
Route::get('/get-product/detail/{id}', [ProductController::class, 'show']);
// Route::get('/get-product',[ProductController::class,'index']);

Route::delete('/delete-product/{id}', [ProductController::class, 'destroy']);
// Route::get('/get-product',[ProductController::class,'index']);


Route::get('/show-subscription', [SubscriptionController::class, 'showsubscription']);


//api to get offers product for home page
Route::get('/week-best-offer', [ProductController::class, 'showweekofferproduct']);
Route::get('/recent-add-products', [ProductController::class, 'showrecentlyaddedproduct']);
Route::get('/most-populer-products', [ProductController::class, 'showmostpopularproduct']);

Route::resource('/accounts', AccountsController::class);
Route::post('/store-account', [AccountsController::class, 'storeAccounts']);

Route::post('/buyer-login', [AccountsController::class, 'login']);
Route::post('/seller-login', [AccountsController::class, 'sellerLogin']);


Route::post('/store-product', [ProductController::class, 'store']);

Route::resource('/accounts', AccountsController::class);
Route::post('/store-account', [AccountsController::class, 'storeAccounts']);
Route::post('/store-invoice', [AccountsController::class, 'storeInvoice']);
Route::get('/sellerproduct/{id}', [ProductController::class, 'sellerproducts']);
Route::get('/get-buyers', [AccountsController::class, 'getBuyers']);
Route::get('/get-sellers', [AccountsController::class, 'getSellers']);

Route::post('/contactus', [ContactController::class, 'contactus']);


Route::get('/search/country', [SearchController::class, 'searchByCountry']);
Route::get('/search/category/{id}', [SearchController::class, 'searchByCategory']);
Route::get('/search/product', [SearchController::class, 'searchByProduct']);

Route::get('/header/list', [HeaderController::class, 'show']);
Route::get('/color/list', [ColorController::class, 'getColors']);
Route::get('/topbar/list',[TopbarController::class,'gettopbar']);
Route::get('/popularsearch/list',[PopularsearchController::class,'show']);
Route::get('/blog/list',[BlogController::class,'show']);



// chat apis
Route::get('/chats', [ChatController::class, 'index']);
Route::post('/createChat', [MessageController::class, 'createChat']);
Route::get('/messages/{chat_id}', [MessageController::class, 'getMessages']);
Route::post('/messages', [MessageController::class, 'sendMessage']);
Route::get('/buyer/chats/{buyer_id}', [ChatController::class, 'getBuyerChats']);
Route::get('/get/chats/id/{id}', [ChatController::class, 'getChatId']);
Route::get('/get/account/info/{id}', [ChatController::class, 'getAccountInfo']);

Route::post('/chat/id', [ChatController::class, 'chatId']);
Route::middleware('auth:sanctum')->group(function () {
Route::get('/get/authdata', [AccountsController::class, 'authInfo']);
});

Route::get('/get-reviews', [ReviewController::class, 'show']);



Route::middleware(sellerAuthenticate::class)->group(function () {

    Route::get('/get-sellers', [AccountsController::class, 'a']);
});
Route::middleware(buyerAuthenticate::class)->group(function () {
    Route::get('/get-buyers', [AccountsController::class, 'getBuyers']);
});
