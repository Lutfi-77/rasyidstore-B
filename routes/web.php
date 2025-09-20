<?php

use App\Http\Controllers\AddresesController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\pages\HomeController;
use App\Http\Controllers\pages\ProductController;
use App\Http\Controllers\pages\TestimonialController;
use App\Http\Controllers\pages\ProductDetailController;
use App\Http\Livewire\Detail;
use App\Http\Controllers\pages\AboutController;
use App\Http\Controllers\pages\CommentController;
use App\Http\Controllers\ProductController as AdminProductController;
use App\Http\Controllers\ProductVariantController;
use App\Models\Category;

use App\Http\Controllers\pages\ContactController;
use App\Http\Controllers\Settings\BannerController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/auth', function () {
    return Inertia::render('Auth/AuthenticationForm', [
        'clearLayout' => true,
    ]);
})->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'loginHandler'])->name('auth.login');
Route::post('/register', [AuthController::class, 'registerHandler'])->name('auth.register');

Route::prefix('/admin')->middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::resource('users', UsersController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', AdminProductController::class);
    Route::resource('attribute', AttributeController::class);
    Route::resource('media', MediaController::class);
    Route::resource('cart', CartController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('address', AddresesController::class);
    Route::resource('discount', DiscountController::class);
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/detail/{id}', Detail::class)->name('product.detail');
Route::post('/detail/addcart', Detail::class)->middleware('auth')->name('product.addtocart');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimoni');
Route::post('/comment/post', [CommentController::class, 'store'])->middleware('auth')->name('store.comment');
