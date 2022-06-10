<?php

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AgentsController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AgenciesController;
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

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/agencies/edit/{id}', [AgenciesController::class, 'edit']);
    Route::post('/agencies/edit/{id}', [AgenciesController::class, 'update']);
    Route::get('/agencies/delete/{id}', [AgenciesController::class, 'destroy']);
    Route::get('/agencies', [AgenciesController::class, 'adminIndex']);
    Route::post('/agencies', [AgenciesController::class, 'store']);

    Route::get('/members', [UsersController::class, 'index']);
    Route::get('/members/delete/{id}', [UsersController::class, 'destroy']);
    Route::get('/members/edit/{id}', [UsersController::class, 'edit']);
    Route::post('/members/edit/{id}', [UsersController::class, 'update']);

    Route::get('/locations', [LocationsController::class, 'index']);
    Route::get('/locations/delete/{id}', [LocationsController::class, 'destroy']);
    Route::get('/locations/edit/{id}', [LocationsController::class, 'edit']);
    Route::post('/locations/edit/{id}', [LocationsController::class, 'update']);

    Route::get('/pictures/{id}', [ImagesController::class, 'index']);
    Route::post('/pictures/{id}', [ImagesController::class, 'store']);
    Route::get('/pictures/edit/{id}', [ImagesController::class, 'edit']);
    Route::get('/pictures/delete/{loc}/{id}', [ImagesController::class, 'destroy']);
    Route::get('/pictures/{loc}/{id}', [ImagesController::class, 'index']);

    Route::get('/orders', [OrderController::class, 'index']);

    Route::get('/agents', [AgentsController::class, 'index']);
    Route::post('/agents/store', [AgentsController::class, 'store']);
});

Route::prefix('agent')->middleware(['auth', 'isAgent'])->group(function () {

    Route::get('/agencies/edit/{id}', [AgenciesController::class, 'edit']);
    Route::post('/agencies/edit/{id}', [AgenciesController::class, 'update']);
    Route::get('/agencies/delete/{id}', [AgenciesController::class, 'destroy']);
    Route::get('/agencies', [AgenciesController::class, 'index']);

    Route::get('/members', [UsersController::class, 'index']);
    Route::get('/members/delete/{id}', [UsersController::class, 'destroy']);
    Route::get('/members/edit/{id}', [UsersController::class, 'edit']);
    Route::post('/members/edit/{id}', [UsersController::class, 'update']);

    Route::get('/locations', [LocationsController::class, 'index']);
    Route::get('/locations/delete/{id}', [LocationsController::class, 'destroy']);
    Route::get('/locations/edit/{id}', [LocationsController::class, 'edit']);
    Route::post('/locations/edit/{id}', [LocationsController::class, 'update']);

    Route::get('/pictures/{id}', [ImagesController::class, 'index']);
    Route::post('/pictures/{id}', [ImagesController::class, 'store']);
    Route::get('/pictures/edit/{id}', [ImagesController::class, 'edit']);
    Route::get('/pictures/delete/{loc}/{id}', [ImagesController::class, 'destroy']);
    Route::get('/pictures/{loc}/{id}', [ImagesController::class, 'index']);

    Route::get('/messages', [ContactController::class, 'show']);
    Route::post('/messages/archive/{id}', [ContactController::class, 'archiveMessage']);
    Route::get('/messages/archives/{id}', [ContactController::class, 'showArchives']);
    Route::post('/messages/restore/{id}', [ContactController::class, 'restore']);

    
});

Route::get('/', [IndexController::class, 'index']);
Route::get('/agencies/show/{id}', [AgenciesController::class, 'showAgency']);
Route::get('/locations/show/{id}', [LocationsController::class, 'showAppartment']);
Route::get('/locations', [LocationsController::class, 'index']);
Route::get('/filter/{city}', [IndexController::class, 'show']);

Route::resource('/agencies', AgenciesController::class);
Route::resource('/locations', LocationsController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'showInfo'])->name('home');
Route::get('/home/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit']);
Route::post('/home/edit/{id}', [App\Http\Controllers\HomeController::class, 'update']);

Route::get('/contact/{id}', [ContactController::class, 'index']);
Route::post('/contact/{id}', [ContactController::class, 'store']);

Auth::routes(['verify' => true]);

Route::get('/email', function()
{   
    Mail::to('rafael.hhenry12345@gmail.com')->send(new WelcomeMail());
    return new WelcomeMail();
});


