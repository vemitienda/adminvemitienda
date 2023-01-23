<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PlansController;
use App\Http\Controllers\Admin\ServicesController;
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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
//     Route::resource('usuarios', UsersController::class);
// });

Route::group(['prefix' => 'admin'], function () {
    Route::resource('usuarios', UsersController::class);
    Route::resource('plans', PlansController::class);
    Route::resource('services', ServicesController::class);
});


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
