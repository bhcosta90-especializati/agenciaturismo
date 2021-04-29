<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group(['as' => 'site.'], function(){
    Route::get('/', [App\Http\Controllers\Site\IndexController::class, 'index'])->name('home');
    Route::get('/promocoes', [App\Http\Controllers\Site\PromotionController::class, 'index'])->name('promotion');
    Route::get('/voos', [App\Http\Controllers\Site\FlightController::class, 'search'])->name('flight.index');
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/voo/confirmacao/{id}', [App\Http\Controllers\Site\FlightController::class, 'confirmation'])->name('flight.confirmation');
        Route::get('/voo/{id}', [App\Http\Controllers\Site\FlightController::class, 'show'])->name('flight.show');
        Route::post('/voo/{id}', [App\Http\Controllers\Site\FlightController::class, 'reserve'])->name('flight.store');
    });
});

Route::group(['as' => 'admin.', 'middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\Admin\IndexController::class, 'index'])->name('home');
    Route::group(['prefix' => 'admin'], function(){
        Route::resource('brand', App\Http\Controllers\Admin\BrandController::class)->except(['show']);
        Route::resource('plane', App\Http\Controllers\Admin\PlaneController::class)->except(['show']);
        Route::get('state', [App\Http\Controllers\Admin\StateController::class, 'index'])->name('state.index');
        Route::get('city', [App\Http\Controllers\Admin\CityController::class, 'index'])->name('city.index');
        Route::resource('airport', App\Http\Controllers\Admin\AirportController::class)->except(['show']);
        Route::resource('flight', App\Http\Controllers\Admin\FlightController::class);
        Route::resource('reserve', App\Http\Controllers\Admin\ReserveController::class)->except(['destroy', 'show']);
    });
});

Auth::routes();
