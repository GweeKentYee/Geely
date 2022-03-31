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
Route::post('/admin/inspection/carModelDropBox','App\Http\Controllers\InspectionController@subOptions')->name('subOptions');
Route::get('/admin/inspection/file/view/{inspectionID}','App\Http\Controllers\InspectionController@viewInspectionFile');
Route::post('/admin/inspection/add','App\Http\Controllers\InspectionController@newInspection');
Route::get('/admin/inspection/delete/{inspectionID}','App\Http\Controllers\InspectionController@delete');
Route::get('/admin/inspection/details/{inspectionID}','App\Http\Controllers\InspectionController@viewDetailsPage');

Route::get('/admin/catalogue','App\Http\Controllers\CatalogueController@viewAdminPage');

Route::get('/admin/newsletter','App\Http\Controllers\NewsletterController@viewAdminPage');
Route::get('/admin/newsletter/view/{newsletterID}','App\Http\Controllers\NewsletterController@viewImage');
Route::post('/admin/newsletter/add','App\Http\Controllers\NewsletterController@add');
Route::get('/admin/newsletter/edit/{newsletterID}','App\Http\Controllers\NewsletterController@viewEditPage');
Route::patch('/admin/newsletter/editfunction/{newsletterID}','App\Http\Controllers\NewsletterController@edit');
Route::get('/admin/newsletter/delete/{newsletterID}','App\Http\Controllers\NewsletterController@delete');

Route::get('/admin/carmodel','App\Http\Controllers\CarModelController@viewAdminPage');

