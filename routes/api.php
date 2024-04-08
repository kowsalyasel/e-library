<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Routes for admin or user login and register
Route::group(
    [], function(){
        Route::post ("register",[App\Http\Controllers\API\AuthController :: class, "register"]);
        Route::post ("login",[App\Http\Controllers\API\AuthController :: class, "login"]);
        Route::get ("/users/sort",[App\Http\Controllers\API\AuthController :: class, "indexSorting"]);
        Route::get ("/users/filter",[App\Http\Controllers\API\AuthController :: class, "indexFiltering"]);
        Route::get ("users",[App\Http\Controllers\API\AuthController :: class, "indexPagination"]);
        Route::get ("/users/search",[App\Http\Controllers\API\AuthController :: class, "indexSearch"]);
        Route::get ("/users/all",[App\Http\Controllers\API\AuthController :: class, "indexUser"]);
        Route::put ("/users/{id}",[App\Http\Controllers\API\AuthController :: class, "update"]);
        Route::delete ("/users/{id}",[App\Http\Controllers\API\AuthController :: class, "destroy"]);
        Route::get ("/users/export",[App\Http\Controllers\API\AuthController :: class, "exportUsersCsv"]);

    }
);


Route::post('/import', [App\Http\Controllers\ImportController :: class, "exportUsersCsv"]);





