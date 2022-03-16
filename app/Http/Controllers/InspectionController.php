<?php

namespace App\Http\Controllers;

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

        $CarModel = CarModel::all();

        return view('Inspection',[
            'CarModel' => $CarModel
        ]);

    }

    public function subCarVariant(Request $request){

        $CarVariants = CarVariant::where('car_model_id',$request->CarModel_id)->get();

        return response()->json([
            'CarVariants' => $CarVariants
        ]);

    }

    public function newInspection(Request $request){

        $data = $request->validate([
            'data_file' => ['required'],
            'car_model' => ['required', Rule::notIn('0')],
            'car_variant' => ['required']
        ]);

        $usedFileName = request()->file('data_file')->getClientOriginalName();

        $usedFilePath = $data['data_file']->move('storage/data/usedcar',$usedFileName);

        $UsedCar = UsedCar::create([
            'file' => str_replace('\\','/',$usedFilePath),
            'status' => "hidden",
            'car_variant_id' => $data['car_variant'],
        ]);

        //Inspection happen here
        //after inspection happen, a file will be generated

        $InspectionFilePath = $usedFilePath;

        Inspection::create([
            'inspection_date' => now(),
            'file' => str_replace('\\','/',$InspectionFilePath),
            'used_car_id' => $UsedCar->id
        ]);

        Catalogue::create([
            'min_price' => 0,
            'max_price' => 0,
            'used_car_id' => $UsedCar->id
        ]);

        return redirect('admin/inspection');

    }

    public function delete($inspectionID){

        $Inspection = Inspection::find($inspectionID);

        $filepath = str_replace('\\','/',public_path($Inspection->file));

        if(file_exists($filepath)){

            unlink($filepath);

        }

        Inspection::where('id',$inspectionID)->delete();

        return redirect('admin/inspection');

    }

    public function viewInspectionFile($inspectionID){

        $Inspection = Inspection::find($inspectionID);

        $file = public_path($Inspection->file);

        return response()->download($file,'',[],'inline');

    }

    public function viewDetailsPage($inspectionID){

        $Inspection = Inspection::find($inspectionID);

        return view('InspectionDetails', [
            'inspection' => $Inspection
        ]);

    }
}
