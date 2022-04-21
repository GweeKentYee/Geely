<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use Illuminate\Http\Request;

use App\Models\UsedCar;
use App\Models\Collection;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarVariant;
use App\Models\CarBodyType;
use App\Models\CarGeneralSpec;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isInfinite;

class CatalogueController extends Controller
{
    public function viewPage(){

        $usedcar = UsedCar::
        join('cars','cars.id','=','used_cars.car_id')
        ->select('*','used_cars.id AS id')
        ->join('car_variants','cars.car_variant_id','=','car_variants.id')
        ->select('*','used_cars.id AS id')
        ->join('car_models','car_variants.car_model_id','=','car_models.id')
        ->select('*','used_cars.id AS id')
        ->join('car_brands','car_models.car_brand_id','=','car_brands.id')
        ->select('*','used_cars.id AS id')
        ->join('car_body_types','cars.car_body_type_id','=','car_body_types.id')
        ->select('*','used_cars.id AS id')
        ->join('car_general_specs','cars.car_general_spec_id','=','car_general_specs.id')
        ->select('*','used_cars.id AS id')
        ->where('status','=','1')->paginate(10);
        $carbrand = CarBrand::orderBy('brand','ASC')->get();
        $carmodel = CarModel::orderBy('model','ASC')->get();
        $carvariant= CarVariant::orderBy('variant','ASC')->get();
        $carbodytype= CarBodyType::orderBy('body_type','ASC')->get();
        $generalspec= CarGeneralSpec::all();
        $collections = Collection::all()->where('user_id',auth()->id());

        return view('Catalogue',
        ['usedcar' => $usedcar,'carbrand'=>$carbrand,'carmodel'=>$carmodel,'carvariant'=>$carvariant,'carbodytype'=>$carbodytype,'generalspec'=>$generalspec,'collections'=> $collections]
        );

    }

    public function viewAdminPage(){

        return view('ManageCatalogue');
    }

    public function search(){
        $usedcar= UsedCar::
        join('cars','cars.id','=','used_cars.car_id')
        ->select('*','used_cars.id AS id')
        ->join('car_variants','cars.car_variant_id','=','car_variants.id')
        ->select('*','used_cars.id AS id')
        ->join('car_models','car_variants.car_model_id','=','car_models.id')
        ->select('*','used_cars.id AS id')
        ->join('car_brands','car_models.car_brand_id','=','car_brands.id')
        ->select('*','used_cars.id AS id')
        ->join('car_body_types','cars.car_body_type_id','=','car_body_types.id')
        ->select('*','used_cars.id AS id')
        ->join('car_general_specs','cars.car_general_spec_id','=','car_general_specs.id')
        ->select('*','used_cars.id AS id')
        ->where('car_models.model','LIKE', '%'.request('query').'%')->where('status','=',1)  
        ->orwhere('car_brands.brand','LIKE', '%'.request('query').'%')->where('status','=',1)   
        ->paginate(10);

        $carbrand = CarBrand::orderBy('brand','ASC')->get();
        $carmodel = CarModel::orderBy('model','ASC')->get();
        $carvariant= CarVariant::orderBy('variant','ASC')->get();
        $carbodytype= CarBodyType::orderBy('body_type','ASC')->get();
        $generalspec= CarGeneralSpec::all();
        $collections = Collection::all()->where('user_id',auth()->id());

        return view('Catalogue',
        ['usedcar' => $usedcar,'carbrand'=>$carbrand,'carmodel'=>$carmodel,'carvariant'=>$carvariant,'carbodytype'=>$carbodytype,'generalspec'=>$generalspec,'collections'=> $collections]        
        );

    }

    public function advanced(){
        $brand = request('brand');
        $year = request('year');
        $minPrice = request('minPrice');
        $maxPrice = request('maxPrice');

        if($year==null || !is_numeric($year)){
            $year=0;
        }

        if($minPrice==null || !is_numeric($minPrice)){
            $minPrice=0;
        }

        if($maxPrice==null || !is_numeric($maxPrice)){
            $maxPrice=UsedCar::max('max_price');
        }
        
        $usedcar = UsedCar::
        select('used_cars.*')
        ->join('cars','cars.id','=','used_cars.car_id')
        ->select('*','used_cars.id AS id')
        ->join('car_variants','cars.car_variant_id','=','car_variants.id')
        ->select('*','used_cars.id AS id')
        ->join('car_models','car_variants.car_model_id','=','car_models.id')
        ->select('*','used_cars.id AS id')
        ->join('car_brands','car_models.car_brand_id','=','car_brands.id')
        ->select('*','used_cars.id AS id')
        ->join('car_body_types','cars.car_body_type_id','=','car_body_types.id')
        ->select('*','used_cars.id AS id')
        ->join('car_general_specs','cars.car_general_spec_id','=','car_general_specs.id')
        ->select('*','used_cars.id AS id')
        ->where('car_models.id','LIKE', '%'.request('model').'%')
        ->where('car_brands.id','LIKE', '%'.request('brand').'%')
        ->where('car_variants.id','LIKE', '%'.request('variant').'%')
        ->where('car_body_types.id','LIKE', '%'.request('bodyType').'%')
        ->where('car_general_specs.id','LIKE', '%'.request('generalSpec').'%')
        ->where('cars.year','>=',$year)
        ->where('used_cars.min_price','>=',$minPrice)
        ->where('used_cars.max_price','<=',$maxPrice)
        ->where('status','1')
        ->paginate(10); 
         
        $carbrand = CarBrand::orderBy('brand','ASC')->get();
        $carmodel = CarModel::orderBy('model','ASC')->get();
        $carvariant= CarVariant::orderBy('variant','ASC')->get();
        $carbodytype= CarBodyType::orderBy('body_type','ASC')->get();
        $generalspec= CarGeneralSpec::all();
        $collections = Collection::all()->where('user_id',auth()->id());

        return view('Catalogue',
        ['usedcar' => $usedcar,'carbrand'=>$carbrand,'carmodel'=>$carmodel,'carvariant'=>$carvariant,'carbodytype'=>$carbodytype,'generalspec'=>$generalspec,'collections'=> $collections]
        );
    }
    
    public function modelOptions(Request $request){

        if($request->CarBrand_id==0){
            $CarModels = CarModel::all();
        }else{
            $CarModels = CarModel::where('car_brand_id',$request->CarBrand_id)->get();
        }

        return response()->json([
            'CarModels' => $CarModels
        ]);

    }

    public function variantOptions(Request $request){
        
        $CarVariants = CarVariant::where('car_model_id',$request->CarModel_id)->get();
        

        return response()->json([
            'CarVariants' => $CarVariants
        ]);

    }

    public function autocompleteSearch(Request $request)
    {
        
        $query = $request->get('query');
        $filterBrand = CarBrand::select('brand')->where('brand', 'LIKE', '%'.$query.'%')->get()->pluck('brand');
        $filterModel = CarModel::select('model')->where('model','LIKE','%'.$query.'%')->get()->pluck("model");
        $filter = $filterBrand->merge($filterModel);
        
        return response()->json($filter);
    }

}
