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

                        $car[] = $usedCars->catalogue;

                    }
                }
            }
        }
        
    
        return view('Catalogue',['car'=>$car,]);

    }

    public function advanced(){
        $car=[];

        $carID = CarModel::select('id')->where('car_model','LIKE', '%'.request('model').'%')->get();

        if($carID->isEmpty()){
            return view('Catalogue',['car'=>$car,]);
        }

        foreach ($carID as $carID){

            $collectID[] = $carID->id;

        }

        $CarModel = CarModel::findMany($collectID);

        foreach ($CarModel as $CarModel){
            foreach ($CarModel->carVariants->where('year','>=',request('year')) as $carVariants){
                foreach($carVariants->usedCars->where('status','show') as $usedCars){
                    if($usedCars->catalogue->min_price >= request('minPrice') || $usedCars->catalogue->max_price <= request('maxPrice')){
                        $car[] = $usedCars->catalogue;
                    }
                }
            }
        }
        
    
        return view('Catalogue',['car'=>$car,]);

    }

}
