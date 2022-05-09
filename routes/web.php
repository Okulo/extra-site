<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::post('home/saveForm', [App\Http\Controllers\HomeController::class, 'saveForm'])->name('saveForm');

Route::get('home/formData', [App\Http\Controllers\HomeController::class, 'formData'])->name('formData');
