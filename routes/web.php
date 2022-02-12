<?php

use App\Http\Controllers\CollectionController; //new added for resource controller
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
// Route::get('/collection','App\Http\Controllers\OldCollectionController@viewPage'); //delete later
Route::resource('collection', CollectionController::class);

Route::get('/admin/inspection','App\Http\Controllers\InspectionController@viewAdminPage');
Route::get('/admin/catalogue','App\Http\Controllers\CatalogueController@viewAdminPage');
Route::get('/admin/newsletter','App\Http\Controllers\NewsletterController@viewAdminPage');
Route::get('/admin/carmodel','App\Http\Controllers\CarModelController@viewAdminPage');

