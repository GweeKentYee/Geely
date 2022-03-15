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
Route::get('/admin/carvariant','App\Http\Controllers\CarVariantController@viewAdminPage');
Route::post('/admin/carvariant/add','App\Http\Controllers\CarVariantController@addCarVariant');
Route::get('/admin/carvariant/delete/{carvariantID}','App\Http\Controllers\CarVariantController@delete');
Route::get('/admin/carvariant/file/viewspecs/{carvariantID}','App\Http\Controllers\CarVariantController@viewSpecsFile');
Route::get('/admin/carvariant/file/viewdata/{carvariantID}','App\Http\Controllers\CarVariantController@viewDataFile');
Route::get('/admin/carvariant/edit/{carvariantID}','App\Http\Controllers\CarVariantController@viewEditPage');
Route::patch('/admin/carvariant/editfunction/{carvariantID}','App\Http\Controllers\CarVariantController@edit');