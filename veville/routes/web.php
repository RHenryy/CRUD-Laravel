<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;

use App\Http\Controllers\MembersController;
use App\Http\Controllers\AgenciesController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\LocationsController;



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


Route::get('/', [IndexController::class, 'index']);



Route::get('agencies/show/{id}', [AgenciesController::class, 'showAgency']);
Route::get('agencies/edit/{id}', [AgenciesController::class, 'edit']);
Route::post('agencies/edit/{id}', [AgenciesController::class, 'update']);
Route::get('agencies/delete/{id}', [AgenciesController::class, 'destroy']);


Route::get('vehicles/show/{id}', [VehiclesController::class, 'showProduct']);
Route::get('vehicles/edit/{id}', [VehiclesController::class, 'edit']);
Route::post('vehicles/edit/{id}', [VehiclesController::class, 'update']);
Route::get('vehicles/delete/{id}', [VehiclesController::class, 'destroy']);

Route::get('members/delete/{id}', [MembersController::class, 'destroy']);
Route::get('members/edit/{id}', [MembersController::class, 'edit']);
Route::post('members/edit/{id}', [MembersController::class, 'update']);

Route::get('locations', [LocationsController::class, 'index']);
Route::post('locations', [LocationsController::class, 'store']);


Route::resource('agencies', AgenciesController::class);
Route::resource('members', UsersController::class);
Route::resource('orders', OrderController::class);
Route::resource('vehicles', VehiclesController::class);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
