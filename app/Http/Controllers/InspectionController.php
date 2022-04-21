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
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

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

        $CarModels = CarModel::find($request->CarBrand_id);

        $CarVariantsID = collect($CarModels->CarVariants->pluck('id'));

        $Cars = Car::whereIn('car_variant_id',$CarVariantsID)->with('carVariant.carModel','carBodyType','carGeneralSpec')->get();

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

        $current_timestamp = Carbon::now()->timestamp;

        $dataFileExtension = request()->file('data_file')->getClientOriginalExtension();

        $dataFileName = $current_timestamp.'_usedcar_data.'.$dataFileExtension;

        $dataFilePath = $data['data_file']->move('storage/data/usedcar/'.$data['reg_num'].'/',$dataFileName);

        $ownershipFileExtension = request()->file('ownership_file')->getClientOriginalExtension();

        $ownershipFileName = $current_timestamp.'_usedcar_ownership.'.$ownershipFileExtension;

        $ownershipFilePath = $data['ownership_file']->move('storage/data/usedcar/'.$data['reg_num'].'/',$ownershipFileName);

        $UsedCar = UsedCar::create([
            'min_price' => 0,
            'max_price' => 0,
            'registration' => $data['reg_num'],
            'data_file' => str_replace('\\','/',$dataFilePath),
            'ownership_file' => str_replace('\\','/',$ownershipFilePath),
            'status' => "0",
            'car_id' => $data['car'],
        ]);

        //Inspection happen here
        //after inspection happen, a file will be generated

        $Car = Car::find($data['car']);

        $NewDataFile = public_path($Car->data_file);

        $reader = new Xlsx();
        $spreadsheet = $reader->load($NewDataFile);
        $sheet = $spreadsheet->getActiveSheet();

        $RetrievedNewData = $sheet->toArray();

        $NewCarObject = [];

        $count = count($RetrievedNewData[0]);

        for($i = 0; $i < $count; $i++){

            $NewCarColumn = [
                $RetrievedNewData[0][$i] => $RetrievedNewData[1][$i]
            ];

            $NewCarObject[] = $NewCarColumn;

        }

        $UsedDataFile = public_path($UsedCar->data_file);

        $reader = new Xlsx();
        $spreadsheet = $reader->load($UsedDataFile);
        $sheet = $spreadsheet->getActiveSheet();

        $RetrievedUsedData = $sheet->toArray();

        $UsedCarObject = [];

        for($i = 0; $i < count($RetrievedUsedData[0]); $i++){

            $UsedCarColumn = [
                $RetrievedUsedData[0][$i] => $RetrievedUsedData[1][$i]
            ];

            $UsedCarObject[] = $UsedCarColumn;

        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $calculate = 0;

        $alphabet = 65;

        for($i = 0; $i < $count ; $i++){

            if(array_keys($NewCarObject[$i]) == array_keys($NewCarObject[$i])){

                $ResultRows = (int) round(( $UsedCarObject[$i][key($UsedCarObject[$i])] / $NewCarObject[$i][key($NewCarObject[$i])] ) * 100);

                $calculate += $ResultRows;

                $CellPos = chr($alphabet);

                $sheet->setCellValue($CellPos.'1', key($UsedCarObject[$i]));
                $sheet->setCellValue($CellPos.'2', $ResultRows.'%');

                $alphabet++;

            }

        }

        $rating = $calculate / count($RetrievedUsedData[0]);

        $sheet->setCellValue($CellPos.'1', "Rating");
        $sheet->setCellValue($CellPos.'2', $rating.'%');

        $writer = new Xlsx($spreadsheet);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $resultpath = 'storage/data/usedcar/'.$UsedCar->registration.'/'.$current_timestamp.'_'.$UsedCar->registration.'_result.xlsx';

        $writer->save($resultpath);

        Inspection::create([
            'inspection_date' => now(),
            'result_file' => str_replace('\\','/',$resultpath),
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
