<?php

use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\CountriesController;
use App\Http\Controllers\admin\SubcategoriesController;
use App\Http\Controllers\admin\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\DashboardController;
// use App\Http\Controllers\admin\HeaderController;
use App\Http\Controllers\admin\SubscriptionController;
use App\Http\Controllers\API\register\AccountsController;
use App\Http\Controllers\API\Seller\ProductController;
use App\Http\Controllers\API\contact\ContactController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\contactInfoController;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\PrivacypolicyController;
use App\Http\Controllers\RefundpolicyController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\TopbarController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PopularsearchController  ;
// Admin login route



// Admin dashboard and other routes protected by middleware
Route::get('admin', function () {
    return view('admin.layout.adminlogin');
})->name('admin');

Route::post('/admin-login', [UsersController::class, 'adminlogin'])->name('admin.login');

Route::post('/admin-logout', [UsersController::class, 'adminlogout'])->name('admin.logout');

// Route::middleware(AdminAuthenticate::class)->group(function () {

    Route::get('/admindashboard', [DashboardController::class, 'index'])->name('admindashboard.index');
    Route::resource('category', CategoriesController::class);
    Route::resource('subcategory', SubcategoriesController::class);
    Route::resource('country',CountriesController::class);
    Route::resource('brand',BrandController::class);
    Route::resource('user',UsersController::class);

Route::post('/store-product',[ProductController::class,'store']);


Route::resource('subscription',SubscriptionController::class);



Route::post('/store-subs',action: [SubscriptionController::class,'storeData'])->name('store.data');
Route::post('/store-product',action: [ProductController::class,'store']);

Route::get('/show-products',[ProductController::class, 'showproducts'] )->name('admin.showproducts');
Route::get('/get-product/detail/{id}',[ProductController::class,'productdetailshow'])->name('admin.product.detail');


Route::post('/admin/products/update-displaytag', [ProductController::class, 'updateDisplayTag'])->name('products.updateDisplayTag');

Route::get('/showallaccounts',[AccountsController::class,'index'])->name('account.index');
Route::get('/account/edit/{id}',[AccountsController::class,'edit'])->name('account.edit');
Route::put('/account/update/{id}', [AccountsController::class, 'update'])->name('account.update');
Route::delete('/account/delete/{id}',[AccountsController::class,'destroy'])->name('account.destroy');



Route::get('/contactlist',[ContactController::class,'index'])->name('contact.index');
Route::delete('/contact-delete/{id}',[ContactController::class,'destroy'])->name('contact.destroy');
Route::post('/admin/contact/status-update',[ContactController::class,'update'])->name('contact.updatestatus');
Route::get('/admin/contact/{id}', [ContactController::class, 'show'])->name('contact.show');


Route::get('/reviewslist',[ReviewController::class,'index'])->name('review.index');
Route::get('/reviews/create',[ReviewController::class,'create'])->name('review.create');
Route::post('/reviews/store',[ReviewController::class,'store'])->name('review.store');
Route::get('/review/edit/{id}',[ReviewController::class,'edit'])->name('review.edit');
Route::put('/review/update/{id}',[ReviewController::class,'update'])->name('review.update');
Route::delete('/review-delete/{id}',[ReviewController::class,'destroy'])->name('review.destroy');

Route::get('/header/list',[HeaderController::class,'index'])->name('header.index');
Route::get('/header/create',[HeaderController::class,'create'])->name('header.create');
Route::post('/header/store',[HeaderController::class,'store'])->name('header.store');
Route::get('/header/edit/{id}',[HeaderController::class,'edit'])->name('header.edit');
Route::put('/header/update/{id}',[HeaderController::class,'update'])->name('header.update');
Route::delete('/header-delete/{id}',[HeaderController::class,'destroy'])->name('header.destroy');

Route::get('/color/list',[ColorController::class,'index'])->name('color.index');
Route::get('/color/create',[ColorController::class,'create'])->name('color.create');
Route::post('/color/store',[ColorController::class,'store'])->name('color.store');
Route::get('/color/edit/{id}',[ColorController::class,'edit'])->name('color.edit');
Route::put('/color/update/{id}',[ColorController::class,'update'])->name('color.update');
Route::delete('/color-delete/{id}',[ColorController::class,'destroy'])->name('color.destroy');


Route::get('/topbar/list',[TopbarController::class,'index'])->name('topbar.index');
Route::get('/topbar/create',[TopbarController::class,'create'])->name('topbar.create');
Route::post('/topbar/store',[TopbarController::class,'store'])->name('topbar.store');
Route::get('/topbar/edit/{id}',[TopbarController::class,'edit'])->name('topbar.edit');
Route::put('/topbar/update/{id}',[TopbarController::class,'update'])->name('topbar.update');
Route::delete('/topbar-delete/{id}',[TopbarController::class,'destroy'])->name('topbar.destroy');



Route::get('/popularsearch/list',[PopularsearchController::class,'index'])->name('popularsearch.index');
Route::get('/popularsearch/create',[PopularsearchController::class,'create'])->name('popularsearch.create');
Route::post('/popularsearch/store',[PopularsearchController::class,'store'])->name('popularsearch.store');
Route::get('/popularsearch/edit/{id}',[PopularsearchController::class,'edit'])->name('popularsearch.edit');
Route::put('/popularsearch/update/{id}',[PopularsearchController::class,'update'])->name('popularsearch.update');
Route::delete('/popularsearch-delete/{id}',[PopularsearchController::class,'destroy'])->name('popularsearch.destroy');


Route::get('/blog/list',[BlogController::class,'index'])->name('blog.index');
Route::get('/blog/create',[BlogController::class,'create'])->name('blog.create');
Route::post('/blog/store',[BlogController::class,'store'])->name('blog.store');
Route::get('/blog/edit/{id}',[BlogController::class,'edit'])->name('blog.edit');
Route::put('/blog/update/{id}',[BlogController::class,'update'])->name('blog.update');
Route::delete('/blog-delete/{id}',[BlogController::class,'destroy'])->name('blog.destroy');

Route::get('/influencer/list',[InfluencerController::class,'index'])->name('influencer.index');
Route::get('/influencer/create',[InfluencerController::class,'create'])->name('influencer.create');
Route::post('/influencer/store',[InfluencerController::class,'store'])->name('influencer.store');
Route::get('/influencer/edit/{id}',[InfluencerController::class,'edit'])->name('influencer.edit');
Route::put('/influencer/update/{id}',[InfluencerController::class,'update'])->name('influencer.update');
Route::delete('/influencer-delete/{id}',[InfluencerController::class,'destroy'])->name('influencer.destroy');

Route::get('/coupon/list',[CouponController::class,'index'])->name('coupon.index');
Route::get('/coupon/create',[CouponController::class,'create'])->name('coupon.create');
Route::post('/coupon/store',[CouponController::class,'store'])->name('coupon.store');
Route::get('/coupon/edit/{id}',[CouponController::class,'edit'])->name('coupon.edit');
Route::put('/coupon/update/{id}',[CouponController::class,'update'])->name('coupon.update');
Route::delete('/coupon-delete/{id}',[CouponController::class,'destroy'])->name('coupon.destroy');


Route::get('/social-media/list',[SocialMediaController::class,'index'])->name('media.index');
Route::get('/social-media/create',[SocialMediaController::class,'create'])->name('media.create');
Route::post('/social-media/store',[SocialMediaController::class,'store'])->name('media.store');
Route::get('/social-media/edit/{id}',[SocialMediaController::class,'edit'])->name('media.edit');
Route::put('/social-media/update/{id}',[SocialMediaController::class,'update'])->name('media.update');
Route::delete('/social-media-delete/{id}',[SocialMediaController::class,'destroy'])->name('media.destroy');

Route::get('/stripe/account/list',[StripeController::class,'index'])->name('stripe.index');
Route::get('/stripe/account/create',[StripeController::class,'create'])->name('stripe.create');
Route::post('/stripe/account/store',[StripeController::class,'store'])->name('stripe.store');
Route::get('/stripe/account/edit/{id}',[StripeController::class,'edit'])->name('stripe.edit');
Route::put('/stripe/account/update/{id}',[StripeController::class,'update'])->name('stripe.update');
Route::delete('/stripe/account-delete/{id}',[StripeController::class,'destroy'])->name('stripe.destroy');

Route::get('/terms/list',[TermController::class,'index'])->name('term.index');
Route::get('/terms/create',[TermController::class,'create'])->name('term.create');
Route::post('/terms/store',[TermController::class,'store'])->name('term.store');
Route::get('/terms/edit/{id}',[TermController::class,'edit'])->name('term.edit');
Route::put('/terms/update/{id}',[TermController::class,'update'])->name('term.update');
Route::delete('/terms-delete/{id}',[TermController::class,'destroy'])->name('term.destroy');

Route::get('/refund/list',[RefundpolicyController::class,'index'])->name('refund.index');
Route::get('/refund/create',[RefundpolicyController::class,'create'])->name('refund.create');
Route::post('/refund/store',[RefundpolicyController::class,'store'])->name('refund.store');
Route::get('/refund/edit/{id}',[RefundpolicyController::class,'edit'])->name('refund.edit');
Route::put('/refund/update/{id}',[RefundpolicyController::class,'update'])->name('refund.update');
Route::delete('/refund-delete/{id}',[RefundpolicyController::class,'destroy'])->name('refund.destroy');

Route::get('/privacy/list',[PrivacypolicyController::class,'index'])->name('privacy.index');
Route::get('/privacy/create',[PrivacypolicyController::class,'create'])->name('privacy.create');
Route::post('/privacy/store',[PrivacypolicyController::class,'store'])->name('privacy.store');
Route::get('/privacy/edit/{id}',[PrivacypolicyController::class,'edit'])->name('privacy.edit');
Route::put('/privacy/update/{id}',[PrivacypolicyController::class,'update'])->name('privacy.update');
Route::delete('/privacy-delete/{id}',[PrivacypolicyController::class,'destroy'])->name('privacy.destroy');

Route::get('/aboutus/list',[AboutusController::class,'index'])->name('aboutus.index');
Route::get('/aboutus/create',[AboutusController::class,'create'])->name('aboutus.create');
Route::post('/aboutus/store',[AboutusController::class,'store'])->name('aboutus.store');
Route::get('/aboutus/edit/{id}',[AboutusController::class,'edit'])->name('aboutus.edit');
Route::put('/aboutus/update/{id}',[AboutusController::class,'update'])->name('aboutus.update');
Route::delete('/aboutus-delete/{id}',[AboutusController::class,'destroy'])->name('aboutus.destroy');

Route::get('/contactInfo/list',[contactInfoController::class,'index'])->name('contactInfo.index');
Route::get('/add/contactInfo/create',[contactInfoController::class,'create'])->name('contactInfo.create');
Route::post('/add/contactInfo/store',[contactInfoController::class,'store'])->name('contactInfo.store');
Route::get('/edit/contactInfo/{id}',[contactInfoController::class,'edit'])->name('contactInfo.edit');
Route::put('/update/contactInfo/update/{id}',[contactInfoController::class,'update'])->name('contactInfo.update');
Route::delete('/contactInfo/delete/{id}',[contactInfoController::class,'destroy'])->name('contactInfo.destroy');


Route::get('/coupon/usage/list',[AccountsController::class,'couponusage'])->name('couponusage.index');

Route::post('/admin/contact/reply', [ContactController::class, 'reply'])->name('contact.reply');

// });