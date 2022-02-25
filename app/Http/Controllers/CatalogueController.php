<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;

use App\Models\UsedCar;
use App\Models\CarModel;
use App\Models\CarVariant;

use function PHPUnit\Framework\isEmpty;

class CatalogueController extends Controller
{
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

        $carID = CarModel::select('id')->where('car_model','LIKE', '%'.request('query').'%')->get();

        if($carID->isEmpty()){
            return view('Catalogue',['car'=>$car,]);
        }

        foreach ($carID as $carID){

            $collectID[] = $carID->id;

        }

        $CarModel = CarModel::findMany($collectID);

        foreach ($CarModel as $CarModel){
            foreach ($CarModel->carVariants as $carVariants){
                foreach($carVariants->usedCars as $usedCars){

                    if($usedCars->status == "show") {

                        $car[] = $usedCars->Catalogue;

                    }
                }
            }
        }
        
    
        return view('Catalogue',['car'=>$car,]);

    }

}
