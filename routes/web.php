<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\IndexController;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\ListingController;
use \App\Http\Controllers\UserAcccountController;
use \App\Http\Controllers\RealtorListingImageController;


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

Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);

Route::resource('listing', ListingController::class)
    ->only([
       'index', 'show'
    ]);
//    ->only(['create','store','edit','update'])
//    ->middleware('auth');
//
//Route::resource('listing', ListingController::class)
//    ->except(['create','store','edit','update','destroy']);

Route::resource('user-account', UserAcccountController::class);

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('listing.offer', \App\Http\Controllers\ListingOfferController::class)
    ->middleware('auth')
    ->only(['store']);

Route::prefix('realtor')
    ->name('realtor.')
    ->middleware('auth')
    ->group(function() {
        Route::name('listing.restore')
            ->put('listing/{listing}/restore',
            [\App\Http\Controllers\RealtorListingController::class, 'restore']
            )->withTrashed();

        Route::resource('listing', \App\Http\Controllers\RealtorListingController::class)
//            ->only(['index', 'destroy', 'edit', 'update', 'create', 'store']);
            ->withTrashed();

        Route::name('offer.accept')
            ->put('offer/{offer}/accept',\App\Http\Controllers\RealtorListingAcceptOfferController::class
        );

        Route::resource('listing.image', RealtorListingImageController::class)
            ->only(['create', 'store', 'destroy']);

    });


