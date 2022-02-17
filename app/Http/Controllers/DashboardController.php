<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    //
    public function viewPage(){

        // $catalogue= Catalogue::whereRelation('usedCar','status','retail')->get();

        // dd($catalogue);

        return view('Dashboard');

    }
}
