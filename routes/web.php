<?php

use App\Http\Controllers\CollectionController; //new added for resource controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 

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
Route::get('/collection/compare', function(){

    // dd(request());
    dd(request()->all());
    // dd(request()->input('collectionID1'));
    // dd(request()->input('collectionID2'));
    
})->name('collection.compare');
Route::post('/collection/compare', function(Request $request){
    $collectionSelected = $request->except('_token');
    // dd($request->all());
    // dd($data);

    $i  = 1;
    foreach ($collectionSelected as $key => $value) {
        
        ${'collectionID' . $i} = $value; 
        $i = $i + 1;
        // echo "<script>console.log('$collectionID1'); </script>";
    }

    return redirect()->route('collection.compare', ['collectionID1' => $collectionID1, 'collectionID2' => $collectionID2]);
})->name('collection.compare');
Route::resource('collection', CollectionController::class);

Route::get('/admin/inspection','App\Http\Controllers\InspectionController@viewAdminPage');
Route::get('/admin/catalogue','App\Http\Controllers\CatalogueController@viewAdminPage');
Route::get('/admin/newsletter','App\Http\Controllers\NewsletterController@viewAdminPage');
Route::get('/admin/carmodel','App\Http\Controllers\CarModelController@viewAdminPage');

