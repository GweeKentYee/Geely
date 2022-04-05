<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarVariant;
use App\Models\CarBodyType;
use App\Models\CarGeneralSpec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function viewAdminPage(){

        $CarBrand = CarBrand::all();

        $CarBodyType = CarBodyType::all();

        $CarGeneralSpec = CarGeneralSpec::all();

        return view('Car', [
            'CarBrand' => $CarBrand,
            'CarBodyType' => $CarBodyType,
            'CarGeneralSpec' => $CarGeneralSpec
        ]);

    }

    public function delete($carID){

        $Car = Car::find($carID);

        if ($Car->spec_file == null) {
            
            unlink($Car->data_file);

        } else {

            unlink($Car->spec_file);

            unlink($Car->data_file);

        }

        Car::where('id', $carID)->delete();

        return redirect('admin/car');

    }

    public function subOptions(Request $request){

        $CarModels = CarModel::where('car_brand_id', $request->CarBrand_id)->get();
        $CarVariants = CarVariant::where('car_brand_id', $request->CarBrand_id)->get();

        return response()->json([
            'CarModels' => $CarModels,
            'CarVariants' => $CarVariants
        ]);

    }

    public function addCar(Request $request){

        $data = $request->validate([
            'car_brand_id' => ['required', Rule::notIn('0')],
            'car_model_id' => ['required', Rule::notIn('0'),
            Rule::unique('cars','car_model_id')->where(function ($query){
                return $query->where('car_variant_id', request('car_variant_id'))->where('year', request('year'))->where('car_body_type_id', request('car_body_type_id'))->where('car_general_spec_id', request('car_general_spec_id'));
            })],
            'car_variant_id' => ['required', Rule::notIn('0'),
            Rule::unique('cars','car_variant_id')->where(function ($query){
                return $query->where('year', request('year'))->where('car_model_id', request('car_model_id'))->where('car_body_type_id', request('car_body_type_id'))->where('car_general_spec_id', request('car_general_spec_id'));
            })],
            'year' => ['required', Rule::notIn('0'), 
            Rule::unique('cars','year')->where(function ($query){
                return $query->where('car_variant_id', request('car_variant_id'))->where('car_body_type_id', request('car_body_type_id'))->where('car_model_id', request('car_model_id'))->where('car_general_spec_id', request('car_general_spec_id'));
            })],
            'car_body_type_id' => ['required', Rule::notIn('0'),
            Rule::unique('cars','car_body_type_id')->where(function ($query){
                return $query->where('car_variant_id', request('car_variant_id'))->where('year', request('year'))->where('car_general_spec_id', request('car_general_spec_id'))->where('car_model_id', request('car_model_id'));
            })],
            'car_general_spec_id' => ['required', Rule::notIn('0'),
            Rule::unique('cars','car_general_spec_id')->where(function ($query){
                return $query->where('car_variant_id', request('car_variant_id'))->where('car_body_type_id', request('car_body_type_id'))->where('year', request('year'))->where('car_model_id', request('car_model_id'));
            })],
            'spec_file' => ['mimes:json,txt,xml,xls,xlsx'],
            'data_file' => ['required', 'mimes:json,txt,xml,xls,xlsx']
        ]);

        // dd(request('car_variant_id'));
        // $JoinCars = CarModel::
        // select('car_models.*')
        // ->join('car_brands','car_brands.id','=','car_models.car_brand_id')
        // ->select('car_models.*')
        // ->join('car_variants','car_variants.car_brand_id','=','car_brands.id')
        // ->where('car_models.id',request('car_model_id'))
        // ->where('car_brands.id',request('car_brand_id'))
        // ->where('car_variants.id',request('car_variant_id'))->get();

        // dd($JoinCars[0]->carBrand->carVariants);

        $dataFileName = request()->file('data_file')->getClientOriginalName();

        // $dataFilePath = $data['data_file']->move('storage/data/car/'.$data['car_brand'].'', $dataFileName);
        $dataFilePath = $data['data_file']->move('storage/data/car', $dataFileName);

        if (request('spec_file')){

            $specFileName = request()->file('spec_file')->getClientOriginalName();

            // $specFilePath = $data['spec_file']->move('storage/data/car/'.$data['car_brand'].'', $specFileName);
            $specFilePath = $data['spec_file']->move('storage/data/car', $specFileName);

            Car::create([
                'car_model_id' => $data['car_model_id'],
                'car_variant_id' => $data['car_variant_id'],
                'year' => $data['year'],
                'car_body_type_id' => $data['car_body_type_id'],
                'car_general_spec_id' => $data['car_general_spec_id'],
                'spec_file' => str_replace('\\', '/', $specFilePath),
                'data_file' => str_replace('\\', '/', $dataFilePath)
            ]);

        } else {

            Car::create([
                'car_model_id' => $data['car_model_id'],
                'car_variant_id' => $data['car_variant_id'],
                'year' => $data['year'],
                'car_body_type_id' => $data['car_body_type_id'],
                'car_general_spec_id' => $data['car_general_spec_id'],
                'data_file' => str_replace('\\', '/', $dataFilePath)
            ]);

        }

        return redirect('admin/car');

    }

    public function viewSpecFile($carID){

        $Car = Car::find($carID);

        $file = public_path($Car->spec_file);

        return response()->download($file, '', [], 'inline');

    }

    public function viewDataFile($carID){

        $Car = Car::find($carID);

        $file = public_path($Car->data_file);

        return response()->download($file, '', [], 'inline');

    }

    public function viewEditPage($carID){

        $Car = Car::find($carID);

        $CarBrand = CarBrand::all();

        $CarBodyType = CarBodyType::all();

        $CarGeneralSpec = CarGeneralSpec::all();

        return view('EditCar', [
            'Car' => $Car,
            'CarBrand' => $CarBrand,
            'CarBodyType' => $CarBodyType,
            'CarGeneralSpec' => $CarGeneralSpec
        ]);

    }

    public function edit($carID, Request $request){

        $Car = Car::find($carID);

        $data = $request->validate([
            'year' => [Rule::notIn('0'), 
            Rule::unique('cars','year')->ignore($carID)->where(function ($query){
                return $query->where('car_body_type_id', request('car_body_type_id'))->where('car_general_spec_id', request('car_general_spec_id'));
            })],
            'car_body_type_id' => [Rule::notIn('0'),
            Rule::unique('cars','car_body_type_id')->ignore($carID)->where(function ($query){
                return $query->where('year', request('year'))->where('car_general_spec_id', request('car_general_spec_id'));
            })],
            'car_general_spec_id' => [Rule::notIn('0'),
            Rule::unique('cars','car_general_spec_id')->ignore($carID)->where(function ($query){
                return $query->where('car_body_type_id', request('car_body_type_id'))->where('year', request('year'));
            })],
            'spec_file' => ['mimes:json,txt,xml,xls,xlsx'],
            'data_file' => ['mimes:json,txt,xml,xls,xlsx']
        ]);

        $input = collect($data)->whereNotNull()->all();

        if(!empty($input)) {

            if(request('spec_file') and request('data_file')) {

                $inputWithoutFile = collect($data)->except(['spec_file','data_file'])->filter()->all();

                if ($Car->spec_file == null) {
            
                    unlink($Car->data_file);
        
                } else {
        
                    unlink($Car->spec_file);
        
                    unlink($Car->data_file);
        
                }

                $specFileName = request()->file('spec_file')->getClientOriginalName();

                $specFilePath = $data['spec_file']->move('storage/data/car', $specFileName);

                $dataFileName = request()->file('data_file')->getClientOriginalName();

                $dataFilePath = $data['data_file']->move('storage/data/car', $dataFileName);

                $updateData = array_merge($inputWithoutFile, [
                    'spec_file' => str_replace('\\','/',$specFilePath),
                    'data_file' => str_replace('\\','/',$dataFilePath)
                ]);

                $Car->update($updateData);

                return redirect('admin/car');

            } else if(request('spec_file')){

                $inputWithoutFile = collect($data)->except('spec_file')->filter()->all();

                if ($Car->spec_file != null) {
        
                    unlink($Car->spec_file);
        
                }

                $fileName = request()->file('spec_file')->getClientOriginalName();

                // $filePath = $data['spec_file']->move('storage/data/car/'.$data['car_brand'].'',$fileName);
                $filePath = $data['spec_file']->move('storage/data/car',$fileName);

                $updateData = array_merge($inputWithoutFile, [
                    'spec_file' => str_replace('\\','/',$filePath)
                ]);

                $Car->update($updateData);

                return redirect('admin/car');

            } else if(request('data_file')) {
                
                $inputWithoutFile = collect($data)->except('data_file')->filter()->all();

                unlink($Car->data_file); // call database column name

                $fileName = request()->file('data_file')->getClientOriginalName();

                $filePath = $data['data_file']->move('storage/data/car',$fileName);

                $updateData = array_merge($inputWithoutFile, [
                    'data_file' => str_replace('\\','/',$filePath)
                ]);

                $Car->update($updateData);

                return redirect('admin/car');

            } else {

                $Car->update($input);

                return redirect('admin/car');

            }

        } else {

            Session::flash('field_empty', 'Please fill in at least one field.');

            return redirect('admin/car/edit/'.$carID);

        }

    }

}
