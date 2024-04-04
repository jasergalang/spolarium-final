<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ChartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/artwork', function () {
    return view('artwork.artworkdashboard');
});
Route::get('art', function () {
    return view('material.create');
});
Route::get('testing', function () {
    return view('layout.testing');
});
Route::get('/event', function () {
    return view('event.dashboard');
});
Route::get('/manageevent', function () {
    return view('event.manageevent');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/charts', [ChartController::class, 'index'])->name('charts.index');
Route::get('/cart', function () {
    return view('cart.cartform');
});

Route::get('/showcase', function () {
    return view('artworkshowcase');
});

Route::get('/checkout', function () {
    return view('cart.checkout');
});
Route::middleware('role:admin')->group(function () {

    Route::get('/event/index', [EventController::class, 'index'])->name('event.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/events', [EventController::class, 'store'])->name('event.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('event.destroy');
    Route::put('events/{id}/restore', [EventController::class, 'restore'])->name('event.restore');

    Route::get('/order/index', [OrderController::class, 'index'])->name('order.index');
    Route::post('orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::get('/material/dashboard', [MaterialController::class, 'dashboard'])->name('material.dashboard');
    Route::get('/material/create', [MaterialController::class, 'create'])->name('material.create');
    Route::post('/material', [MaterialController::class, 'store'])->name('material.store');
    Route::get('/material/{id}/edit', [MaterialController::class, 'edit'])->name('material.edit');
    Route::put('/material/{id}', [MaterialController::class, 'update'])->name('material.update');
    Route::delete('/material/{id}', [MaterialController::class, 'destroy'])->name('material.destroy');
    Route::put('/material/{id}/restore', [MaterialController::class, 'restore'])->name('material.restore');
     Route::get('/chart', [ChartController::class, 'index'])->name('chart');
});

Route::middleware('role:artist')->group(function () {

    Route::get('/profile', [AuthController::class, 'show'])->name('user.profile');

    Route::get('/artwork/dashboard', [ArtworkController::class, 'dashboard'])->name('artwork.dashboard');
    Route::get('/artwork/create', [ArtworkController::class, 'create'])->name('artwork.create');
    Route::post('/artwork', [ArtworkController::class, 'store'])->name('artwork.store');
    Route::get('/artworks/{id}/edit', [ArtworkController::class, 'edit'])->name('artwork.edit');
    Route::put('/artworks/{id}', [ArtworkController::class, 'update'])->name('artwork.update');
    Route::delete('/artworks/{id}', [ArtworkController::class, 'destroy'])->name('artwork.destroy');
    Route::put('/artwork/{id}/restore', [ArtworkController::class, 'restore'])->name('artwork.restore');
    Route::get('/artwork/trashed', [ArtworkController::class, 'trashed'])->name('artwork.trashed');
    Route::delete('/user/{id}/deactivate', [UserController::class, 'destroyforuser'])->name('user.destroyforuser');

    Route::get('/blog/dashboard', [BlogController::class, 'dashboard'])->name('blogs.show');
    Route::get('/blog/index', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/destroy/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    Route::put('/blogs/{id}/restore', [BlogController::class, 'restore'])->name('blogs.restore');

    Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::put('/user/{id}/restore', [UserController::class, 'restore'])->name('user.restore');



});

Route::middleware('role:customer')->group(function () {

    Route::get('/home', [ArtworkController::class, 'home'])->name('home');

    Route::get('/artwork/home', [ArtworkController::class, 'homeArtwork'])->name('artwork.homeArtwork');
    Route::get('/artwork/index', [ArtworkController::class, 'index'])->name('artwork.index');
    Route::get('/artworks/{id}', [ArtworkController::class, 'show'])->name('artwork.show');
    Route::get('/artworks/{id}', [BlogController::class, 'show'])->name('artwork.show');
    Route::get('/blog/dashboard', [BlogController::class, 'dashboard'])->name('blogs.show');
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::post('/placeorder', [CartController::class, 'placeorder'])->name('order.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/cart/add-artwork', [CartController::class, 'addArtworkToCart'])->name('cart.addArtwork');
    Route::post('/cart/add-material', [CartController::class, 'addMaterialToCart'])->name('cart.addMaterial');
    Route::put('/cart/material/{materialId}', [CartController::class, 'updateMaterialQuantity'])->name('cart.updateMaterialQuantity');
    Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{id}/material',  [CartController::class, 'destroyMaterial'])->name('cart.material.destroy');
    Route::delete('/cart/{id}/artwork',  [CartController::class, 'destroyArtwork'])->name('cart.artwork.destroy');
    Route::delete('/user/{id}/deactivate', [UserController::class, 'destroyforuser'])->name('user.destroyforuser');

    Route::get('/material/{id}', [MaterialController::class, 'show'])->name('material.show');
    Route::get('/material/home', [MaterialController::class, 'homeMaterial'])->name('material.homeMaterial');
    Route::get('/material/index', [MaterialController::class, 'index'])->name('material.index');

    Route::get('/event/dashboard', [EventController::class, 'dashboard'])->name('event.dashboard');

    Route::get('/order/', [OrderController::class, 'show'])->name('order.show');

    Route::post('orders/{id}/update', [OrderController::class, 'update'])->name('orders.update');

});

//Registration
Route::get('artregister', [AuthController::class, 'artistRegister'])->name('artregister');
Route::post('artregister', [AuthController::class, 'artRegister'])->name('artregister.store');
Route::get('cusregister', [AuthController::class, 'customerRegister'])->name('cusregister');
Route::post('cusregister', [AuthController::class, 'cusRegister'])->name('cusregister.store');


//login
Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('verify/{token}', [AuthController::class, 'verify']);

//email verification
Route::get('/email/verify', [VerificationController::class, 'sendVerificationEmail'])->name('verification.send');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['signed'])->name('verification.verify');


//Events


//BlogsCrud



//ArtworkCrud



//MaterialCrud


//UserCrud


//login



Route::get('/search', [AuthController::class, 'search'])->name('search');

//charts

