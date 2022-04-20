<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CarVariantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function viewAdminPage(){

        $CarBrand = CarBrand::all();

        return view('CarVariant', [
            'CarBrand' => $CarBrand
        ]);

    }

    public function delete($carvariantID){

        CarVariant::where('id', $carvariantID)->delete();

        return redirect('admin/brand_model_variant')->withInput(['tab'=>'carvarianttab']);

    }

    public function subOptions(Request $request){

        $CarModels = CarModel::where('car_brand_id', $request->CarBrand_id)->get();

        return response()->json([
            'CarModels' => $CarModels
        ]);

    }

    public function addCarVariant(Request $request){

        $validator = Validator::make($request->all(), [
            'car_model' => ['required', Rule::notIn('0')],
            'variant' => ['required', 
            Rule::unique('car_variants','variant')->where(function ($query){
                return $query->where('car_model_id', request('car_model'));
            })]
        ]);
 
        if ($validator->fails()) {
            return redirect('admin/brand_model_variant')
                        ->withErrors($validator)
                        ->withInput(['tab'=>'carvarianttab'])
                        ->with('error_code', 3);
        }

        $data = $validator->validated();

        Carvariant::create([
            'car_model_id' => $data['car_model'],
            'variant' => $data['variant']
        ]);

        return redirect('admin/brand_model_variant')->withInput(['tab'=>'carvarianttab']);

    }

    public function viewEditPage($carvariantID){

        $CarVariant = CarVariant::find($carvariantID);

        $CarModel = CarModel::all();

        return view('EditCarVariant', [
            'CarVariant' => $CarVariant,
            'CarModel' => $CarModel
        ]);

    }

    public function edit($carvariantID, Request $request){

        $CarVariant = CarVariant::find($carvariantID);

        $data = $request->validate([
            'variant' => [ 
            Rule::unique('car_variants','variant')->ignore($carvariantID)->where(function ($query) use($CarVariant){
                return $query->where('car_model_id', $CarVariant->car_model_id);
            })]
        ]);

        $input = collect($data)->whereNotNull()->all();

        if(!empty($input)) {

            $CarVariant->update($input);

            return redirect('admin/brand_model_variant')->withInput(['tab'=>'carvarianttab']);

        } else {
            
            Session::flash('field_empty', 'Please fill in at least one field.');

            return redirect('admin/carvariant/edit/'.$carvariantID);

        }

    }

}
