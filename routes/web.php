<?php

use App\Http\Controllers\CollectionController; //new added for resource controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/','App\Http\Controllers\DashboardController@viewPage');
Route::post('/registration/customer','App\Http\Controllers\Auth\RegisterController@registerUser');

Route::get('/catalogue','App\Http\Controllers\CatalogueController@viewPage')->name('catalogue.viewpage');
Route::get('/catalogue/search','App\Http\Controllers\CatalogueController@search');
Route::get('/catalogue/advanced','App\Http\Controllers\CatalogueController@advanced');
Route::post('/catalogue/advanced/modelDropBox','App\Http\Controllers\CatalogueController@modelOptions')->name('modelOption');
Route::post('/catalogue/advanced/variantDropBox','App\Http\Controllers\CatalogueController@variantOptions')->name('variantOption');
Route::get('autocompleteSearch','App\Http\Controllers\CatalogueController@autocompleteSearch')->name('autocompleteSearch');

Route::get('/cardetails/{used_car_id}','App\Http\Controllers\UsedCarController@viewdetailpage')->name('UsedCarDetails');

Route::post('/collection/comparison','App\Http\Controllers\ComparisonController@viewPage');
Route::post('/cardetails/collection/store','App\Http\Controllers\CollectionController@CarDetailsStore');

Route::resource('collection', CollectionController::class);

Route::group(['middleware' => ['auth', 'is_admin']], function () {

    Route::get('/admin/register','App\Http\Controllers\AdminController@adminRegisterPage');
    Route::post('/registration/admin','App\Http\Controllers\AdminController@registerAdmin');

    Route::get('/admin/newsletter','App\Http\Controllers\NewsletterController@viewAdminPage');
    Route::get('/admin/newsletter/view/{newsletterID}','App\Http\Controllers\NewsletterController@viewImage');
    Route::post('/admin/newsletter/add','App\Http\Controllers\NewsletterController@add');
    Route::get('/admin/newsletter/edit/{newsletterID}','App\Http\Controllers\NewsletterController@viewEditPage');
    Route::patch('/admin/newsletter/editfunction/{newsletterID}','App\Http\Controllers\NewsletterController@edit');
    Route::get('/admin/newsletter/delete/{newsletterID}','App\Http\Controllers\NewsletterController@delete');

    Route::get('/admin/brand_model_variant','App\Http\Controllers\CarBrandController@viewTabPage');

    Route::get('/admin/carbrand','App\Http\Controllers\CarBrandController@viewAdminPage');
    Route::post('/admin/carbrand/add','App\Http\Controllers\CarBrandController@addCarBrand');
    Route::get('/admin/carbrand/delete/{carbrandID}','App\Http\Controllers\CarBrandController@delete');
    Route::get('/admin/carbrand/edit/{carbrandID}','App\Http\Controllers\CarBrandController@viewEditPage');
    Route::patch('/admin/carbrand/editfunction/{carbrandID}','App\Http\Controllers\CarBrandController@edit');

    Route::get('/admin/carmodel','App\Http\Controllers\CarModelController@viewAdminPage');
    Route::post('/admin/carmodel/add','App\Http\Controllers\CarModelController@addCarModel');
    Route::get('/admin/carmodel/delete/{carmodelID}','App\Http\Controllers\CarModelController@delete');
    Route::get('/admin/carmodel/edit/{carmodelID}','App\Http\Controllers\CarModelController@viewEditPage');
    Route::patch('/admin/carmodel/editfunction/{carmodelID}','App\Http\Controllers\CarModelController@edit');

    Route::get('/admin/carvariant','App\Http\Controllers\CarVariantController@viewAdminPage');
    Route::post('/admin/carvariant/optionDropBox','App\Http\Controllers\CarVariantController@subOptions')->name('subOptions');
    Route::post('/admin/carvariant/add','App\Http\Controllers\CarVariantController@addCarVariant');
    Route::get('/admin/carvariant/delete/{carvariantID}','App\Http\Controllers\CarVariantController@delete');
    Route::get('/admin/carvariant/edit/{carvariantID}','App\Http\Controllers\CarVariantController@viewEditPage');
    Route::patch('/admin/carvariant/editfunction/{carvariantID}','App\Http\Controllers\CarVariantController@edit');

    Route::get('/admin/car','App\Http\Controllers\CarController@viewAdminPage');
    Route::post('/admin/car/modelDropBox','App\Http\Controllers\CarController@subModels')->name('subModels');
    Route::post('/admin/car/variantDropBox','App\Http\Controllers\CarController@subVariants')->name('subVariants');
    Route::post('/admin/car/add','App\Http\Controllers\CarController@addCar');
    Route::get('/admin/car/delete/{carID}','App\Http\Controllers\CarController@delete');
    Route::get('/admin/car/file/viewspec/{carID}','App\Http\Controllers\CarController@viewSpecFile');
    Route::get('/admin/car/file/viewdata/{carID}','App\Http\Controllers\CarController@viewDataFile');
    Route::get('/admin/car/edit/{carID}','App\Http\Controllers\CarController@viewEditPage');
    Route::patch('/admin/car/editfunction/{carID}','App\Http\Controllers\CarController@edit');

    Route::get('/admin/usedcar/delete/{id}','App\Http\Controllers\UsedCarController@delete');
    Route::get('/admin/usedcar/fetch/{id}','App\Http\Controllers\UsedCarController@fetch');
    Route::get('/admin/usedcar/edit/{id}','App\Http\Controllers\UsedCarController@edit');
    Route::patch('/admin/usedcar/edit/{id}','App\Http\Controllers\UsedCarController@update');
    Route::get('/admin/usedcar/images/{id}','App\Http\Controllers\UsedCarImageController@viewAdminPage');
    Route::get('/admin/usedcar','App\Http\Controllers\UsedCarController@viewAdminPage');
    Route::get('/admin/usedcar/file/viewdata/{id}','App\Http\Controllers\UsedCarController@viewDataFile');
    Route::get('/admin/usedcar/file/viewownership/{id}','App\Http\Controllers\UsedCarController@viewOwnershipFile');

    Route::post('/admin/usedcarImage/store','App\Http\Controllers\UsedCarImageController@store');
    Route::get('/usedcarImage/delete/{id}','App\Http\Controllers\UsedCarImageController@delete');
    Route::get('/usedCarImage/delete/selected','App\Http\Controllers\UsedCarImageController@deleteSelected');
    Route::put('/usedcarImage/update/{id}','App\Http\Controllers\UsedCarImageController@update');

    Route::get('/admin/inspection','App\Http\Controllers\InspectionController@viewAdminPage');
    Route::post('/admin/inspection/carDropBox','App\Http\Controllers\InspectionController@carOptions')->name('carOption');
    Route::get('/admin/inspection/file/view/{inspectionID}','App\Http\Controllers\InspectionController@viewInspectionFile');
    Route::post('/admin/inspection/add','App\Http\Controllers\InspectionController@newInspection');
    Route::post('/admin/inspection/exist/add','App\Http\Controllers\InspectionController@newExistingCarInspection');
    Route::get('/admin/inspection/delete/{inspectionID}','App\Http\Controllers\InspectionController@delete');
    Route::get('/admin/inspection/details/{inspectionID}','App\Http\Controllers\InspectionController@viewDetailsPage');
});
