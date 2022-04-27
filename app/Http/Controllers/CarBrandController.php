<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CarBrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewTabPage(){

        $CarBrand = CarBrand::all();

        return view('BrandModelVariant', [
            'CarBrand' => $CarBrand,
            'CarBrand2' => $CarBrand
        ]);
    }

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

    public function viewEditPage($carbrandID){

        $CarBrand = CarBrand::find($carbrandID);

        return view('EditCarBrand', [
            'CarBrand' => $CarBrand
        ]);

    }

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

    public function delete($carbrandID){

        CarBrand::where('id', $carbrandID)->delete();

        return redirect('admin/brand_model_variant');

    }

}
