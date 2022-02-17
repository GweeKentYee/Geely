<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;

use App\Models\UsedCar;
use App\Models\CarModel;
use App\Models\CarVariant;

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

    public function search(){
        $query = $_GET['query'];
        $name = CarModel::where('car_model','LIKE', '%'.$query.'%')->first();
        $carvar= CarVariant::where('car_model_id','=',$name->id)->first();
        $usedcar = UsedCar::where('id','=',$carvar->id)->first();
        $car = Catalogue::where('id','=',$usedcar->id)->get();
        return view('Catalogue',['car'=>$car,]);

    }

}
