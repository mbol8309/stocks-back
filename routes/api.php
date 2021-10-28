<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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

Route::post('login',[AuthController::class,'login']);

//add this middleware to ensure that every request is authenticated
Route::middleware('auth:api')->group(function(){
    Route::get('user', [AuthController::class,'authenticatedUserDetails']);

    Route::prefix('category')->group(function(){
        Route::get('/',[CategoryController::class,'index']);
        Route::post('/',[CategoryController::class,'store']);
        Route::put('/{id}',[CategoryController::class,'update'])->whereNumber('id');
        Route::delete('/{id}',[CategoryController::class,'delete'])->whereNumber('id');
    });
});


