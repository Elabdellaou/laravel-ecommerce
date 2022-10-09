<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CountryController,deviseController,CityController, Controller, HomeController,TrailerTypeController,TrailerController};
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



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');


//devise
Route::get('/devise', [DeviseController::class, 'index'])->name('devise');
Route::post('/devise', [DeviseController::class, 'store']);
Route::post('/devise/update', [DeviseController::class, 'update']);
Route::get('/devise/delete/{id}', [DeviseController::class, 'delete']);
Route::get('/devise/{id}/show', [DeviseController::class, 'show']);

//city
Route::get('/city', [CityController::class, 'index'])->name('city');
Route::post('/city', [CityController::class, 'store']);
Route::get('/city/{id}/show', [CityController::class, 'show']);
Route::post('/city/update', [CityController::class, 'update']);
Route::get('/city/delete/{id}', [CityController::class, 'delete']);
Route::get('/city/search/{name}', [CityController::class, 'search']);
Route::get('/city/edit/{id}/{active}', [CityController::class, 'update_active']);



//country
Route::get('/country', [CountryController::class, 'index'])->name('country');
Route::post('/country', [CountryController::class, 'store']);
Route::post('/country/update', [CountryController::class, 'update']);
Route::get('/country/delete/{id}', [CountryController::class, 'delete']);
Route::get('/country/{id}/show', [CountryController::class, 'show']);


//Trailer type

Route::get('/trailer-type', [TrailerTypeController::class, 'index'])->name('trailertype');
Route::post('/trailer-type', [TrailerTypeController::class, 'store']);
Route::post('/trailer-type/update', [TrailerTypeController::class, 'update']);
Route::get('/trailer-type/delete/{id}', [TrailerTypeController::class, 'delete']);
Route::get('/trailer-type/{id}/show', [TrailerTypeController::class, 'show']);


//traile
Route::get('/trailer', [TrailerController::class, 'index'])->name('trailer');
Route::post('/trailer', [TrailerController::class, 'store']);
Route::post('/trailer/update', [TrailerController::class, 'update']);
Route::get('/trailer/delete/{id}', [TrailerController::class, 'delete']);
Route::get('/trailer/{id}/show', [TrailerController::class, 'show']);

