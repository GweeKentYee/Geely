<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsedCar;
use App\Models\Collection;
use App\Models\Inspection;
use NunoMaduro\Collision\Adapters\Laravel\Inspector;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
class UsedCarController extends Controller
{

    public function viewdetailpage($used_car_id){

            $usedcar = UsedCar::find($used_car_id);
            $collections = Collection::all()->where('user_id',auth()->id());

            $Inspection = Inspection::select('result_file')->where('used_car_id', $used_car_id)->latest()->first();
            $File = public_path($Inspection->result_file);

            $reader = new ReaderXlsx();
            $spreadsheet = $reader->load($File);
            $sheet = $spreadsheet->getActiveSheet();
            
            $worksheetInfo = $reader->listWorksheetInfo($File);
            $Data = $sheet->toArray();


            return view('UsedCarDetails',
            ['usedcar' => $usedcar,  'collections'=> $collections, 'Data' => $Data]);
        }


}