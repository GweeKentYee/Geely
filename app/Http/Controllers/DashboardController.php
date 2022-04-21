<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Newsletter;
use App\Models\UsedCar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    //
    public function viewPage(){

        $Dash = Newsletter::orderby('ID','DESC')->where('status', 'Show')->get();

        $usedcar = UsedCar::all()->where('status','1');

        return view('Dashboard',
        ['Dash' => $Dash,],['usedcar' => $usedcar,]);

    }
}
