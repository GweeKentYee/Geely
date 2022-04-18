<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UsedCar;

class CollectionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $collections = DB::table('used_cars')
                ->join('cars', 'used_cars.car_id', '=', 'cars.id')
                ->join('car_body_types','cars.car_body_type_id','=','car_body_types.id')
                ->join('car_general_specs','cars.car_general_spec_id','=','car_general_specs.id')
                ->join('car_variants', 'cars.car_variant_id', '=', 'car_variants.id')
                ->join('car_models', 'cars.car_model_id', '=', 'car_models.id')
                ->join('car_brands', 'car_models.car_brand_id',"=","car_brands.id")
                ->join('collections', 'collections.used_car_id', '=', 'used_cars.id')  
                ->where('collections.user_id', '=', auth()->id())
                ->get();
       
        return view('Collection', ['collections' => $collections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function viewdetailpage($used_car_id){

        $usedcar = UsedCar::find($used_car_id); 

        $collections = Collection::all()->where('user_id',auth()->id());


        return view('UsedCarDetails',
        ['usedcar' => $usedcar,  'collections'=> $collections]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $collection = new Collection();
        $collection->used_car_id = $request->input("usedcar_id");
        $collection->user_id = auth()->id();
        $collection->save();

        return redirect()->route('catalogue.viewpage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $collection = Collection::findOrFail($id);
        $collection->delete();


        return redirect()->route('collection.index')->withStatus('successfully removed.');
    }


}
