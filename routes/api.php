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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/admin/register','App\Http\Controllers\Auth\RegisterController@registerAdminApi');

Route::get('/inspection','App\Http\Controllers\DataTableController@inspection')->name('api.inspection');
Route::get('/car','App\Http\Controllers\DataTableController@car')->name('api.car');
Route::get('/carbrand','App\Http\Controllers\DataTableController@carbrand')->name('api.carbrand');
Route::get('/carmodel','App\Http\Controllers\DataTableController@carmodel')->name('api.carmodel');
Route::get('/carvariant','App\Http\Controllers\DataTableController@carvariant')->name('api.carvariant');
Route::get('/newsletter','App\Http\Controllers\DataTableController@newsletter')->name('api.newsletter');
Route::get('/usedcar','App\Http\Controllers\DataTableController@usedcar')->name('api.usedcar');
