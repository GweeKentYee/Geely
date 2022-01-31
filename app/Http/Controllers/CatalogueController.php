<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\UsedCar;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    //
    //
    public function viewPage(){
        $car = Catalogue::all();
        return view('Catalogue',
        ['car' => $car,]
    );

    }

    public function viewAdminPage(){

        return view('ManageCatalogue');

    }

}
