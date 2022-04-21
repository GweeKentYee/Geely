<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarVariant;
use App\Models\Catalogue;
use App\Models\Inspection;
use App\Models\UsedCar;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class InspectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function adminRegisterPage(){

        return view('auth/registerAdmin');

    }

    protected function registerAdmin(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => "Admin",
            'password' => Hash::make($data['password']),

        ]);

        return redirect('/admin/inspection');
    }


    public function viewAdminPage(){

        $CarBrand = CarBrand::all();

        $UsedCars = UsedCar::all();

        return view('Inspection',[
            'CarBrand' => $CarBrand,
            'UsedCars' => $UsedCars
        ]);
    }

    public function carOptions(Request $request){

        $CarModelID = CarModel::select('id')->where('car_brand_id',$request->CarBrand_id)->get();

        $CarVariantsID = CarVariant::select('id')->whereIn('car_model_id',$CarModelID->pluck('id'))->get();

        $Cars = Car::whereIn('car_variant_id',$CarVariantsID->pluck('id'))->with('carVariant.carModel','carBodyType','carGeneralSpec')->get();

        return response()->json([
            'Cars' => $Cars
        ]);

    }

    public function newInspection(Request $request){

        $data = $request->validate([
            'car' => ['required', Rule::notIn('0')],
            'registration_number' => ['required','unique:used_cars,registration'],
            'data_file' => ['required'],
            'ownership_file' => ['required'],
        ]);

        $current_timestamp = Carbon::now()->timestamp;

        $dataFileExtension = request()->file('data_file')->getClientOriginalExtension();

        $dataFileName = $current_timestamp.'_usedcar_data.'.$dataFileExtension;

        $dataFilePath = $data['data_file']->move('storage/data/usedcar/'.$data['registration_number'].'/',$dataFileName);

        $ownershipFileExtension = request()->file('ownership_file')->getClientOriginalExtension();

        $ownershipFileName = $current_timestamp.'_usedcar_ownership.'.$ownershipFileExtension;

        $ownershipFilePath = $data['ownership_file']->move('storage/data/usedcar/'.$data['registration_number'].'/',$ownershipFileName);

        $UsedCar = UsedCar::create([
            'min_price' => 0,
            'max_price' => 0,
            'registration' => $data['registration_number'],
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

        $comparison_count = 0;

        $alphabet = 65;

        for($i = 0; $i < $count ; $i++){

            for($j = 0; $j < count($RetrievedUsedData[0]) ; $j++){

                if(array_keys($NewCarObject[$i]) == array_keys($UsedCarObject[$j])){

                    $ResultRows = (int) round(( $UsedCarObject[$j][key($UsedCarObject[$j])] / $NewCarObject[$i][key($NewCarObject[$i])] ) * 100);

                    $calculate += $ResultRows;

                    $CellPos = chr($alphabet);

                    $sheet->setCellValue($CellPos.'1', key($NewCarObject[$i]));
                    $sheet->setCellValue($CellPos.'2', $ResultRows.'%');

                    $alphabet++;

                    $comparison_count++;

                }

            }

        }

        $rating = (int) round($calculate / $comparison_count);

        $CellPos = chr($alphabet);

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

    public function newExistingCarInspection(Request $request){

        $data = $request->validate([
            'registration_option' => ['required',Rule::notIn('0')],
            'data_file' => ['required'],
            'ownership_file' => ['nullable'],
        ]);

        $UsedCar = UsedCar::find($data['registration_option']);

        $current_timestamp = Carbon::now()->timestamp;

        $dataFileExtension = request()->file('data_file')->getClientOriginalExtension();

        $dataFileName = $current_timestamp.'_usedcar_data.'.$dataFileExtension;

        $dataFilePath = $data['data_file']->move('storage/data/usedcar/'.$data['registration_option'].'/',$dataFileName);

        if (request('ownership_file')){

            $ownershipOldFilePath = str_replace('\\','/',public_path($UsedCar->ownership_file));

            if(file_exists($ownershipOldFilePath)){

                unlink($ownershipOldFilePath);

            }

            $ownershipFileExtension = request()->file('ownership_file')->getClientOriginalExtension();

            $ownershipFileName = $current_timestamp.'_usedcar_ownership.'.$ownershipFileExtension;

            $ownershipFilePath = $data['ownership_file']->move('storage/data/usedcar/'.$data['registration_option'].'/',$ownershipFileName);

            $UsedCar->update([
                'data_file' => str_replace('\\','/',$dataFilePath),
                'ownership_file' => str_replace('\\','/',$ownershipFilePath)
            ]);

        } else {

            $UsedCar->update([
                'data_file' => str_replace('\\','/',$dataFilePath)
            ]);

        }

        $NewDataFile = public_path($UsedCar->car->data_file);

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

        $comparison_count = 0;

        $alphabet = 65;

        for($i = 0; $i < $count ; $i++){

            for($j = 0; $j < count($RetrievedUsedData[0]) ; $j++){

                if(array_keys($NewCarObject[$i]) == array_keys($UsedCarObject[$j])){

                    $ResultRows = (int) round(( $UsedCarObject[$j][key($UsedCarObject[$j])] / $NewCarObject[$i][key($NewCarObject[$i])] ) * 100);

                    $calculate += $ResultRows;

                    $CellPos = chr($alphabet);

                    $sheet->setCellValue($CellPos.'1', key($NewCarObject[$i]));
                    $sheet->setCellValue($CellPos.'2', $ResultRows.'%');

                    $alphabet++;

                    $comparison_count++;

                }

            }

        }

        $rating = (int) round($calculate / $comparison_count);

        $CellPos = chr($alphabet);

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
