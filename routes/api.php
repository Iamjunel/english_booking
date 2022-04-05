<?php

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

Route::get('company', 'App\Http\Controllers\CompanyController@getAllCompany');
Route::get('company/details/{id}', 'App\Http\Controllers\CompanyController@getCompanyById');
Route::post('company', 'App\Http\Controllers\CompanyController@store');
Route::patch('company/{id}', 'App\Http\Controllers\CompanyController@update');
Route::delete('company/{id}', 'App\Http\Controllers\CompanyController@deleteCompanyById');

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
