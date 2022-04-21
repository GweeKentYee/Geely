<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Collection;
use App\Models\Newsletter;
use App\Models\UsedCar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    //
    public function viewPage(){

        $Dash = Newsletter::orderby('ID','DESC')->get();

        $usedcar = UsedCar::
        join('cars','cars.id','=','used_cars.car_id')
        ->select('*','used_cars.id AS id')
        ->join('car_variants','cars.car_variant_id','=','car_variants.id')
        ->select('*','used_cars.id AS id')
        ->join('car_models','cars.car_variant_id','=','car_models.id')
        ->select('*','used_cars.id AS id')
        ->join('car_brands','car_models.car_brand_id','=','car_brands.id')
        ->select('*','used_cars.id AS id')
        ->join('car_general_specs','car_general_specs.id','=','cars.car_general_spec_id')
        ->select('*','used_cars.id AS id')
        ->join('car_body_types','car_body_types.id','=','cars.car_body_type_id')
        ->select('*','used_cars.id AS id')
        ->where('status','1')->take(3)->get();

        $collections = Collection::all()->where('user_id',auth()->id());

        return view('Dashboard', 
        ['Dash' => $Dash,],['usedcar' => $usedcar,],['collections'=> $collections]);

    }
}
