<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewAdminPage(){

        return view('Inspection');

    }
}
