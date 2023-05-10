<?php

use App\Helpers\CRON;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PlansController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\PlanServicesController;
use App\Http\Controllers\Admin\PlanUsersController;
use App\Http\Controllers\Admin\PaymentMethodsController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\PruebasController;
use App\Http\Controllers\SendEmailsController;

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
    return redirect()->route('login');
});
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loguear', [LoginController::class, 'loguear'])->name('loguear');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/masivo', [SendEmailsController::class, 'masivo'])->name('masivo');

Route::get('/pruebas/{quantity}', [PruebasController::class, 'sumarDias'])->name('pruebas');

// Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('usuarios', UsersController::class);
    Route::resource('plans', PlansController::class);
    Route::resource('planusers', PlanUsersController::class);
    Route::resource('paymentmethods', PaymentMethodsController::class);
    Route::resource('payments', PaymentsController::class);
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
