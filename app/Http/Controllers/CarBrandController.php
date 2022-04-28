<?php

// This controller was created for handling Car Brand actions
// No special package used

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CarBrandController extends Controller
{

    // This function is used to ensure the users are authenticated to use this controller's function
    public function __construct()
    {
        $this->middleware('auth');
    }

    // This function is used for viewing the Brand/Model/Variant page
    public function viewTabPage(){

        $CarBrand = CarBrand::all();

        return view('BrandModelVariant', [
            'CarBrand' => $CarBrand,
            'CarBrand2' => $CarBrand
        ]);
    }

    // This function is used for adding new car brand
    public function addCarBrand(Request $request){

        $validator = Validator::make($request->all(), [
            'brand' => ['required',
            Rule::unique('car_brands','brand')->where(function ($query){
                return $query;
            })]
        ]);

        if ($validator->fails()) {
            return redirect('admin/brand_model_variant')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error_code', 1);
        }

        $data = $validator->validated();

        CarBrand::create([
            'brand' => $data['brand']
        ]);

        return redirect('admin/brand_model_variant');

    }

    // This function is used for viewing the Edit CarBrand page
    public function viewEditPage($carbrandID){

        $CarBrand = CarBrand::find($carbrandID);

        return view('EditCarBrand', [
            'CarBrand' => $CarBrand
        ]);

    }

    // This function is used for editing an existing car brand record
    public function edit($carbrandID, Request $request){

        $CarBrand = CarBrand::find($carbrandID);

        $data = $request->validate([
            'brand' => [
            Rule::unique('car_brands','brand')->ignore($carbrandID)->where(function ($query){
                return $query;
            })]
        ]);

        $input = collect($data)->whereNotNull()->all();

        if(!empty($input)) {

            $CarBrand->update($input);

            return redirect('admin/brand_model_variant');

        } else {

            Session::flash('field_empty', 'Please fill in the field.');

            return redirect('admin/carbrand/edit/'.$carbrandID);

        }

    }

    // This function is used for deleting an existing car brand record
    public function delete($carbrandID){

        CarBrand::where('id', $carbrandID)->delete();

        return redirect('admin/brand_model_variant');

    }

}
