<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;

use App\Models\UsedCar;
use App\Models\CarModel;
use App\Models\CarVariant;

use function PHPUnit\Framework\isEmpty;

class CatalogueController extends Controller
{
    //
    //
    public function viewPage(){
        $usedcar = UsedCar::all()->where('status','show');

        foreach($usedcar as $usedcars){
            $car[] = $usedcars->catalogue;
        }
        
        return view('Catalogue',
        ['car' => $car,]
    );

    }

    public function viewAdminPage(){

        return view('ManageCatalogue');

    }

    public function search(){
        $car=[];
        $usedcar = [];

        $name = CarModel::where('car_model','LIKE', '%'.request('query').'%')->get();

        if($name->isEmpty()){
            return view('Catalogue',['car'=>$car,]);
        }

        foreach($name as $names){
            $carvar = $names->carVariants;
        }

        foreach($carvar as $carvars){
            $carvarID[] = $carvars->id;

        }
        
        $usedcar = UsedCar::findMany($carvarID)->where('status','show');

        foreach($usedcar as $usedcars){

            $car[] =  $usedcars->catalogue;

        }

        return view('Catalogue',['car'=>$car,]);

    }

}
