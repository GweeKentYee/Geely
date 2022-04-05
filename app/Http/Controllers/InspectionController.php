<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarVariant;
use App\Models\Catalogue;
use App\Models\Inspection;
use App\Models\UsedCar;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class InspectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewAdminPage(){

        $CarBrand = CarBrand::all();

        return view('Inspection',[
            'CarBrand' => $CarBrand,
        ]);
    }

    public function carOptions(Request $request){

        $CarModels = CarModel::select('id')->where('car_brand_id',$request->CarBrand_id)->get();

        $Cars = Car::whereIn('car_model_id',$CarModels->pluck('id'))->with('carModel','carVariant','carBodyType','carGeneralSpec')->get();

        return response()->json([
            'Cars' => $Cars
        ]);

    }

    public function newInspection(Request $request){

        $data = $request->validate([
            'car' => ['required', Rule::notIn('0')],
            'reg_num' => ['required','unique:used_cars,registration'],
            'data_file' => ['required'],
            'ownership_file' => ['required'],
        ]);

        $usedFileName = request()->file('data_file')->getClientOriginalName();

        $usedFilePath = $data['data_file']->move('storage/data/usedcar',$usedFileName);

        $ownershipFileName = request()->file('ownership_file')->getClientOriginalName();

        $ownershipFilePath = $data['ownership_file']->move('storage/data/usedcar',$ownershipFileName);

        $UsedCar = UsedCar::create([
            'min_price' => 0,
            'max_price' => 0,
            'registration' => $data['reg_num'],
            'data_file' => str_replace('\\','/',$usedFilePath),
            'ownership_file' => str_replace('\\','/',$ownershipFilePath),
            'status' => "1",
            'car_id' => $data['car'],
        ]);

        //Inspection happen here
        //after inspection happen, a file will be generated

        $InspectionFilePath = $usedFilePath;

        Inspection::create([
            'inspection_date' => now(),
            'result_file' => str_replace('\\','/',$InspectionFilePath),
            'used_car_id' => $UsedCar->id
        ]);

        return redirect('admin/inspection');

    }

    public function delete($inspectionID){

        $Inspection = Inspection::find($inspectionID);

        $InspectionFilePath = str_replace('\\','/',public_path($Inspection->result_file));

        if(file_exists($InspectionFilePath)){

            unlink($InspectionFilePath);

        }

        Inspection::where('id',$inspectionID)->delete();

        return redirect('admin/inspection');

    }

    public function viewInspectionFile($inspectionID){

        $Inspection = Inspection::find($inspectionID);

        $file = public_path($Inspection->result_file);

        return response()->download($file,'',[],'inline');

    }

    public function viewDetailsPage($inspectionID){

        $Inspection = Inspection::find($inspectionID);

        return view('InspectionDetails', [
            'inspection' => $Inspection
        ]);

    }
}
