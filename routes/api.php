<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get_all_cats', [MainController::class, 'get_all_cats'])->name('all_cats');
Route::get('get_sub_cats', [MainController::class, 'get_all_cats'])->name('sub_cats');
Route::get('get_models/{id}', [MainController::class, 'get_models'])->name('get_models');
Route::get('get_properties/{id}', [MainController::class, 'get_properties'])->name('get_properties');
