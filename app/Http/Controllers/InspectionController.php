<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\UsedCar;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewAdminPage(){

        // $latestinspection = Inspection::select('file')->where('used_car_id',1)->latest('inspection_date')->first();

        // $HAHA = UsedCar::find(1);

        // $inspection = $HAHA->inspections;

        return view('Inspection');

    }
}
