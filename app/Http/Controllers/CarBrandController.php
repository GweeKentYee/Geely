<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class CarBrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function viewAdminPage(){

        return view('CarBrand');

    }

    public function delete($carbrandID){

        CarBrand::where('id', $carbrandID)->delete();

        return redirect('admin/carbrand');

    }

    public function addCarBrand(Request $request){

        $data = $request->validate([
            'brand' => ['required', 
            Rule::unique('car_brands','brand')->where(function ($query){
                return $query;
            })]
        ]);

        CarBrand::create([
            'brand' => $data['brand']
        ]);

        return redirect('admin/carbrand');

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

            return redirect('admin/carbrand');

        } else {
            
            Session::flash('field_empty', 'Please fill in the field.');

            return redirect('admin/carbrand/edit/'.$carbrandID);

        }

    }

}
