<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OauthProviderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\OauthProvider;
use Illuminate\Support\Facades\Route;



//////////////////////////////////////
// Admin Area
//////////////////////////////////////

Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/admin/authenticate', [AuthController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::post('/upload-image', [ArticleController::class, 'uploadImage'])->name('upload_image');
// Hanya admin yang bisa mengakses route ini
Route::middleware(['isAdmin'])->group(function () {
    // Route dashboard home
    Route::get('admin/', [AuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/profile', [AuthController::class, 'profile'])->name('admin.profile');
    Route::put('admin/profile', [AuthController::class, 'updateProfile'])->name('admin.profile.update');

    // Route user
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('admin/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Route admin
    Route::get('admin/admins', [AdminController::class, 'index'])->name('admin.admins.index');
    Route::get('admin/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
    Route::post('admin/admins', [AdminController::class, 'store'])->name('admin.admins.store');
    Route::get('admin/admins/{id}', [AdminController::class, 'show'])->name('admin.admins.show');
    Route::get('admin/admins/{id}/edit', [AdminController::class, 'edit'])->name('admin.admins.edit');
    Route::put('admin/admins/{id}', [AdminController::class, 'update'])->name('admin.admins.update');
    Route::delete('admin/admins/{id}', [AdminController::class, 'destroy'])->name('admin.admins.destroy');

    // Route product
    Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('admin/products/{id}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::get('admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // route categories
    Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::get('admin/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
    Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // route tags
    Route::get('admin/tags', [TagController::class, 'index'])->name('admin.tags.index');
    Route::post('admin/tags', [TagController::class, 'store'])->name('admin.tags.store');
    Route::get('admin/tags/create', [TagController::class, 'create'])->name('admin.tags.create');
    Route::get('admin/tags/{tag}', [TagController::class, 'show'])->name('admin.tags.show');
    Route::get('admin/tags/{tag}/edit', [TagController::class, 'edit'])->name('admin.tags.edit');
    Route::put('admin/tags/{tag}', [TagController::class, 'update'])->name('admin.tags.update');
    Route::delete('admin/tags/{tag}', [TagController::class, 'destroy'])->name('admin.tags.destroy');

    // route articles
    Route::get('admin/articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    Route::post('admin/articles', [ArticleController::class, 'store'])->name('admin.articles.store');
    Route::get('admin/articles/create', [ArticleController::class, 'create'])->name('admin.articles.create');
    Route::get('admin/articles/{article}', [ArticleController::class, 'show'])->name('admin.articles.show');
    Route::get('admin/articles/{article}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::put('admin/articles/{article}', [ArticleController::class, 'update'])->name('admin.articles.update');
    Route::delete('admin/articles/{article}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');
    Route::post('admin/articles/{article}/publish', [ArticleController::class, 'publish'])->name('admin.articles.publish');
    Route::post('admin/articles/{article}/unpublish', [ArticleController::class, 'unpublish'])->name('admin.articles.unpublish');

    // route chat
    Route::get('admin/chat', [ChatController::class, 'index'])->name('admin.chat.index');

    // route order
    Route::get('admin/order', [OrderController::class, 'index'])->name('admin.order.index');
});

 

//////////////////////////////////////
// User Front Area
//////////////////////////////////////
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/loginregister', [FrontendController::class, 'loginRegister'])->name('frontend.login_register');
Route::post('/register-action', [FrontendController::class, 'registerAction'])->name('frontend.register_action');
Route::post('/login-action', [FrontendController::class, 'loginAction'])->name('frontend.login_action');
Route::get('/article/{slug}', [FrontendController::class, 'article'])->name('frontend.article');
Route::get('/product/{slug}', [FrontendController::class, 'product'])->name('frontend.product');

Route::get('/oauth/{provider}', [OauthProviderController::class, 'redirectToProvider'])->name('oauth.google.redirect');  
Route::get('/oauth/google/callback', [OauthProviderController::class, 'handleGoogleCallback'])->name('oauth.google.callback');


Route::middleware(['auth'])->group(function () {    
    Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('frontend.about_us');
    Route::get('/cart', [FrontendController::class, 'cart'])->name('frontend.cart');
    Route::get('/profile', [FrontendController::class, 'profile'])->name('frontend.profile');
    Route::put('/update-profile', [FrontendController::class, 'updateProfile'])->name('frontend.update_profile');
    Route::get('/logout', [FrontendController::class, 'logout'])->name('frontend.logout');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('frontend.cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('frontend.cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('frontend.cart.remove');
    Route::get('/checkout', [FrontendController::class, 'checkout'])->name('frontend.checkout');
    Route::get('/payment', [FrontendController::class, 'payment'])->name('frontend.payment');
    Route::get('/order-tracking', [FrontendController::class, 'orderTracking'])->name('frontend.order_tracking');
    Route::get('/livechat', [FrontendController::class, 'livechat'])->name('frontend.livechat');
    Route::get('/order-history', function() {return view('frontend.order_history');})->name('frontend.order_history');
});

Route::redirect('/laravel/login', '/loginregister')->name('login');