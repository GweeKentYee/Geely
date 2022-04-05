<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\CarVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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

        return redirect('admin/carvariant');

    }

    public function addCarVariant(Request $request){

        $data = $request->validate([
            'car_brand_id' => ['required', Rule::notIn('0')],
            'variant' => ['required', 
            Rule::unique('car_variants','variant')->where(function ($query){
                return $query->where('car_brand_id', request('car_brand_id'));
            })]
        ]);

        Carvariant::create([
            'car_brand_id' => $data['car_brand_id'],
            'variant' => $data['variant']
        ]);

        return redirect('admin/carvariant');

    }

    public function viewEditPage($carvariantID){

        $CarVariant = CarVariant::find($carvariantID);

        $CarBrand = CarBrand::all();

        return view('EditCarVariant', [
            'CarVariant' => $CarVariant,
            'CarBrand' => $CarBrand
        ]);

    }

    public function edit($carvariantID, Request $request){

        $CarVariant = CarVariant::find($carvariantID);

        $data = $request->validate([
            'car_brand_id' => [Rule::notIn('0')],
            'variant' => [ 
            Rule::unique('car_variants','variant')->ignore($carvariantID)->where(function ($query){
                return $query->where('car_brand_id', request('car_brand_id'));
            })]
        ]);

        $input = collect($data)->whereNotNull()->all();

        if(!empty($input)) {

            $CarVariant->update($input);

            return redirect('admin/carvariant');

        } else {
            
            Session::flash('field_empty', 'Please fill in at least one field.');

            return redirect('admin/carvariant/edit/'.$carvariantID);

        }

    }

}
