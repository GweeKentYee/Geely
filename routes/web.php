<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function(){
//     return redirect()->route('login');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/','App\Http\Controllers\DashboardController@viewPage');
Route::get('/catalogue','App\Http\Controllers\CatalogueController@viewPage');
Route::get('/collection','App\Http\Controllers\CollectionController@viewPage');

Route::get('/admin/inspection','App\Http\Controllers\InspectionController@viewAdminPage');
Route::get('/admin/catalogue','App\Http\Controllers\CatalogueController@viewAdminPage');
Route::get('/admin/newsletter','App\Http\Controllers\NewsletterController@viewAdminPage');
Route::get('/admin/carmodel','App\Http\Controllers\CarModelController@viewAdminPage');
Route::get('/admin/usedcar','App\Http\Controllers\UsedCarController@viewAdminPage');



Route::get('/carmodel/delete/{id}','App\Http\Controllers\CarModelController@delete');
Route::get('/admin/carmodel/add','App\Http\Controllers\CarModelController@create');
Route::get('/carmodel/edit/{id}','App\Http\Controllers\CarModelController@edit');
Route::put('/carmodel/update/{id}','App\Http\Controllers\CarModelController@update');
Route::get('/carmodel/fetch/{id}','App\Http\Controllers\CarModelController@fetch');

Route::get('/usedcar/delete/{id}','App\Http\Controllers\UsedCarController@delete');
Route::get('/usedcar/fetch/{id}','App\Http\Controllers\UsedCarController@fetch');
Route::get('/usedcar/edit/{id}','App\Http\Controllers\UsedCarController@edit');
Route::put('/usedcar/update/{id}','App\Http\Controllers\UsedCarController@update');
Route::get('/usedcar/details/{id}','App\Http\Controllers\UsedCarImageController@viewAdminPage');

Route::post('/admin/usedcarImage/store','App\Http\Controllers\UsedCarImageController@store');
Route::get('/usedcarImage/delete/{id}','App\Http\Controllers\UsedCarImageController@delete');
Route::get('/usedcarImage/edit/{id}','App\Http\Controllers\UsedCarImageController@edit');
Route::put('/usedcarImage/update/{id}','App\Http\Controllers\UsedCarImageController@update');





