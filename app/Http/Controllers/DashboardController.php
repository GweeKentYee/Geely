<?php

// This controller was created for handling Dashboard actions
// No special package used

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Collection;
use App\Models\Newsletter;
use App\Models\UsedCar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    // This function is used to view the Dashboard page
    public function viewPage(){

        $Dash = Newsletter::orderby('ID','DESC')->where('status', 'Show')->get();

        $usedcar = UsedCar::orderBy('id', 'DESC')->with('Car.carBodyType','Car.carGeneralSpec','Car.carVariant.carModel')->take(3)->get();

        $collections = Collection::all()->where('user_id',auth()->id());

        return view('Dashboard',
        ['Dash' => $Dash,],['usedcar' => $usedcar,],['collections'=> $collections]);

    }
}
