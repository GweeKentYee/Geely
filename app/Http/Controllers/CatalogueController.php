<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;

use App\Models\UsedCar;
use App\Models\Collection;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\CarVariant;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isInfinite;

class CatalogueController extends Controller
{
    public function viewPage(){
        //$usedcar = UsedCar::all()->where('status','1');

        $usedcar = UsedCar::all()->where('status','1');
        $collections = Collection::all()->where('user_id',auth()->id());


        return view('Catalogue',
        ['usedcar' => $usedcar, 'collections'=> $collections]
        );

    }

    public function viewAdminPage(){

        return view('ManageCatalogue');
    }

    public function search(){
        $usedcar = UsedCar::
        select('used_cars.*')
        ->join('cars','cars.id','=','used_cars.car_id')
        ->select('*','used_cars.id AS id')
        ->join('car_models','cars.car_model_id','=','car_models.id')
        ->where('car_models.model','LIKE', '%'.request('query').'%')
        ->where('status','1')
        ->get();

        $collections = Collection::all()->where('user_id',auth()->id());


        // $car=[];

        // $carID = CarModel::select('id')->where('car_model','LIKE', '%'.request('query').'%')->get();

        // if($carID->isEmpty()){
        //     return view('Catalogue',['car'=>$car,]);
        // }

        // foreach ($carID as $carID){

        //     $collectID[] = $carID->id;

        // }

        // $CarModel = CarModel::findMany($collectID);

        // foreach ($CarModel as $CarModel){
        //     foreach ($CarModel->carVariants as $carVariants){
        //         foreach($carVariants->usedCars as $usedCars){

        //             if($usedCars->status == "show") {

        //                 $car[] = $usedCars->catalogue;

        //             }
        //         }
        //     }
        // }
        
    
        return view('Catalogue',
        ['usedcar' => $usedcar, 'collections'=> $collections]
        );

    }

    public function advanced(){
        $year = request('year');
        $minPrice = request('minPrice');
        $maxPrice = request('maxPrice');

        if($year==null){
            $year=0;
        }

        if($minPrice==null){
            $minPrice=0;
        }

        if($maxPrice==null){
            $maxPrice=UsedCar::max('max_price');
        }
        
        $usedcar = UsedCar::
        select('used_cars.*')
        ->join('cars','cars.id','=','used_cars.car_id')
        ->select('*','used_cars.id AS id')
        ->join('car_models','cars.car_model_id','=','car_models.id')
        ->where('car_models.model','LIKE', '%'.request('model').'%')
        ->where('cars.year','>=',$year)
        ->where('used_cars.min_price','>=',$minPrice)
        ->where('used_cars.max_price','<=',$maxPrice)
        ->where('status','1')
        ->get();

        $collections = Collection::all()->where('user_id',auth()->id());


        // $usedcar = UsedCar::
        // join('cars','cars.id','=','used_cars.car_id')
        // ->leftJoin('car_models','car_models.id','=','cars.car_model_id')
        // ->where('car_models.model','like','%'.request('query').'%')
        // ->where('cars.year','>=',request('year'))
        // ->where('used_cars.min_price','>',request('minPrice'))
        // ->where('used_cars.max_price','<',request('maxPrice'))
        // ->where('used_cars.status','1')
        // ->get();

        // $car=[];

        // $carID = CarModel::select('id')->where('car_model','LIKE', '%'.request('model').'%')->get();

        // if($carID->isEmpty()){
        //     return view('Catalogue',['car'=>$car,]);
        // }

        // foreach ($carID as $carID){

        //     $collectID[] = $carID->id;

        // }

        // $CarModel = CarModel::findMany($collectID);

        // foreach ($CarModel as $CarModel){
        //     foreach ($CarModel->carVariants->where('year','>=',request('year')) as $carVariants){
        //         foreach($carVariants->usedCars->where('status','show') as $usedCars){
        //             if($usedCars->catalogue->min_price >= request('minPrice') || $usedCars->catalogue->max_price <= request('maxPrice')){
        //                 $car[] = $usedCars->catalogue;
        //             }
        //         }
        //     }
        // }
        
    
        return view('Catalogue',
        ['usedcar' => $usedcar, 'collections'=> $collections]
        );
    }
    

}
