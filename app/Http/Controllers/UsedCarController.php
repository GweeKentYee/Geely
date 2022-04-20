<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsedCar;
use App\Models\Collection;

class UsedCarController extends Controller
{
    //
    public function viewPage(){

        //  $usedcar = UsedCar::where('status','1')->paginate(20);
        // //  $usedcar = UsedCar::find($used_car_id);
        // $collections = Collection::all()->where('user_id',auth()->id());

        //  return view('UsedCarDetails',
        //  ['usedcar' => $usedcar,  'collections'=> $collections]
        //   );       
        //  

    }

    public function viewdetailpage($used_car_id){

            $usedcar = UsedCar::find($used_car_id); 

            $collections = Collection::all()->where('user_id',auth()->id());


            return view('UsedCarDetails',
            ['usedcar' => $usedcar,  'collections'=> $collections]);
        }
}