<?php

use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\CountriesController;
use App\Http\Controllers\admin\SubcategoriesController;
use App\Http\Controllers\admin\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\API\Seller\ProductController;

// Admin login route



// Admin dashboard and other routes protected by middleware
Route::get('admin', function () {
    return view('admin.layout.adminlogin');
})->name('admin');


    Route::get('/admindashboard', [DashboardController::class, 'index'])->name('admindashboard.index');
    Route::resource('category', CategoriesController::class);
    Route::resource('subcategory', SubcategoriesController::class);
    Route::resource('country',CountriesController::class);
    Route::resource('brand',BrandController::class);
    Route::resource('user',UsersController::class);

Route::post('/store-product',[ProductController::class,'store']);





