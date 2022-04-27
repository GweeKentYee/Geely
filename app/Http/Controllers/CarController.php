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
use Carbon\Carbon;

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

    public function subModels(Request $request){

        $CarModels = CarModel::where('car_brand_id', $request->CarBrand_id)->get();

        return response()->json([
            'CarModels' => $CarModels
        ]);

    }

    public function subVariants(Request $request){

        $CarVariants = CarVariant::where('car_model_id', $request->CarModel_id)->get();

        return response()->json([
            'CarVariants' => $CarVariants
        ]);

    }

    public function addCar(Request $request){

        $data = $request->validate([
            'car_variant' => ['required', Rule::notIn('0'),
            Rule::unique('cars','car_variant_id')->where(function ($query){
                return $query->where('year', request('year'))->where('car_body_type_id', request('car_body_type'))->where('car_general_spec_id', request('car_general_spec'));
            })],
            'year' => ['required', Rule::notIn('0'),
            Rule::unique('cars','year')->where(function ($query){
                return $query->where('car_variant_id', request('car_variant'))->where('car_body_type_id', request('car_body_type'))->where('car_general_spec_id', request('car_general_spec'));
            })],
            'car_body_type' => ['required', Rule::notIn('0'),
            Rule::unique('cars','car_body_type_id')->where(function ($query){
                return $query->where('car_variant_id', request('car_variant'))->where('year', request('year'))->where('car_general_spec_id', request('car_general_spec'));
            })],
            'car_general_spec' => ['required', Rule::notIn('0'),
            Rule::unique('cars','car_general_spec_id')->where(function ($query){
                return $query->where('car_variant_id', request('car_variant'))->where('car_body_type_id', request('car_body_type'))->where('year', request('year'));
            })],
            'spec_file' => ['mimes:json,txt,xml,xls,xlsx'],
            'data_file' => ['required', 'mimes:xls,xlsx']
        ]);

        $Car = Car::create([
            'car_variant_id' => $data['car_variant'],
            'year' => $data['year'],
            'car_body_type_id' => $data['car_body_type'],
            'car_general_spec_id' => $data['car_general_spec'],
            'data_file' => 'temp'
        ]);

        $current_timestamp = Carbon::now()->timestamp;

        if (request('spec_file')){

            $specFileExtension = request()->file('spec_file')->getClientOriginalExtension();

            $specFileName = $current_timestamp.'_'.$Car->year.'_'.$Car->carVariant->variant.'_'.$Car->carBodyType->body_type.'_'.$Car->carGeneralSpec->transmission.'_'.$Car->carGeneralSpec->fuel.'_spec.'.$specFileExtension;

            $specFilePath = $data['spec_file']->move('storage/data/car/'.$Car->carVariant->carModel->carBrand->brand.'/'.$Car->carVariant->carModel->model.'', $specFileName);

            $dataFileExtension = request()->file('data_file')->getClientOriginalExtension();

            $dataFileName = $current_timestamp.'_'.$Car->year.'_'.$Car->carVariant->variant.'_'.$Car->carBodyType->body_type.'_'.$Car->carGeneralSpec->transmission.'_'.$Car->carGeneralSpec->fuel.'_data.'.$dataFileExtension;

            $dataFilePath = $data['data_file']->move('storage/data/car/'.$Car->carVariant->carModel->carBrand->brand.'/'.$Car->carVariant->carModel->model.'', $dataFileName);

            $Car->update([
                'spec_file' => str_replace('\\', '/', $specFilePath),
                'data_file' => str_replace('\\', '/', $dataFilePath)
            ]);

        } else {

            $dataFileExtension = request()->file('data_file')->getClientOriginalExtension();

            $dataFileName = $current_timestamp.'_'.$Car->year.'_'.$Car->carVariant->variant.'_'.$Car->carBodyType->body_type.'_'.$Car->carGeneralSpec->transmission.'_'.$Car->carGeneralSpec->fuel.'_data.'.$dataFileExtension;

            $dataFilePath = $data['data_file']->move('storage/data/car/'.$Car->carVariant->carModel->carBrand->brand.'/'.$Car->carVariant->carModel->model.'', $dataFileName);

            $Car->update([
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
            'spec_file' => ['mimes:json,txt,xml,xls,xlsx'],
            'data_file' => ['mimes:xls,xlsx']
        ]);

        $current_timestamp = Carbon::now()->timestamp;

        if(request('spec_file') and request('data_file')) {

            if ($Car->spec_file == null) {

                unlink($Car->data_file);

            } else {

                unlink($Car->spec_file);

                unlink($Car->data_file);

            }

            $specFileExtension = request()->file('spec_file')->getClientOriginalExtension();

            $specFileName = $current_timestamp.'_'.$Car->year.'_'.$Car->carVariant->variant.'_'.$Car->carBodyType->body_type.'_'.$Car->carGeneralSpec->transmission.'_'.$Car->carGeneralSpec->fuel.'_spec.'.$specFileExtension;

            $specFilePath = $data['spec_file']->move('storage/data/car/'.$Car->carVariant->carModel->carBrand->brand.'/'.$Car->carVariant->carModel->model.'', $specFileName);

            $dataFileExtension = request()->file('data_file')->getClientOriginalExtension();

            $dataFileName = $current_timestamp.'_'.$Car->year.'_'.$Car->carVariant->variant.'_'.$Car->carBodyType->body_type.'_'.$Car->carGeneralSpec->transmission.'_'.$Car->carGeneralSpec->fuel.'_data.'.$dataFileExtension;

            $dataFilePath = $data['data_file']->move('storage/data/car/'.$Car->carVariant->carModel->carBrand->brand.'/'.$Car->carVariant->carModel->model.'', $dataFileName);

            $updateData =  [
                'spec_file' => str_replace('\\','/',$specFilePath),
                'data_file' => str_replace('\\','/',$dataFilePath)
            ];

            $Car->update($updateData);

            return redirect('admin/car');

        } else if(request('spec_file')){

            if ($Car->spec_file != null) {

                unlink($Car->spec_file);

            }

            $specFileExtension = request()->file('spec_file')->getClientOriginalExtension();

            $specFileName = $current_timestamp.'_'.$Car->year.'_'.$Car->carVariant->variant.'_'.$Car->carBodyType->body_type.'_'.$Car->carGeneralSpec->transmission.'_'.$Car->carGeneralSpec->fuel.'_spec.'.$specFileExtension;

            $specFilePath = $data['spec_file']->move('storage/data/car/'.$Car->carVariant->carModel->carBrand->brand.'/'.$Car->carVariant->carModel->model.'', $specFileName);

            $updateData = [
                'spec_file' => str_replace('\\','/',$specFilePath)
            ];

            $Car->update($updateData);

            return redirect('admin/car');

        } else if(request('data_file')) {

            unlink($Car->data_file); // call database column name

            $dataFileExtension = request()->file('data_file')->getClientOriginalExtension();

            $dataFileName = $current_timestamp.'_'.$Car->year.'_'.$Car->carVariant->variant.'_'.$Car->carBodyType->body_type.'_'.$Car->carGeneralSpec->transmission.'_'.$Car->carGeneralSpec->fuel.'_data.'.$dataFileExtension;

            $dataFilePath = $data['data_file']->move('storage/data/car/'.$Car->carVariant->carModel->carBrand->brand.'/'.$Car->carVariant->carModel->model.'', $dataFileName);

            $updateData = [
                'data_file' => str_replace('\\','/',$dataFilePath)
            ];

            $Car->update($updateData);

            return redirect('admin/car');

        } else {

            Session::flash('field_empty', 'Please fill in at least one field.');

            return redirect('admin/car/edit/'.$carID);

        }


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

}
