<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    //
    public function viewPage(){

        $Dash = Newsletter::all();

        return view('Dashboard', 
        ['Dash' => $Dash,]);

    }
}
