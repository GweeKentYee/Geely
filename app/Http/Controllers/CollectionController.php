<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('Collection', ['collections' => Collection::all()->where('user_id', '=', auth()->id())]);

        // $collections = DB::table('collections')
        //         ->join('catalogues', 'collections.catalogue_id', '=', 'catalogues.id')
        //         ->join('used_cars', 'catalogues.used_car_id', '=', 'used_cars.id')
        //         ->join('car_variants', 'used_cars.car_variant_id', '=', 'car_variants.id')
        //         ->join('car_models', 'car_variants.car_model_id', '=', 'car_models.id')
        //         ->where('collections.user_id', '=', auth()->id())
        //         ->get();

        $collections = DB::table('car_models')
                ->join('car_variants', 'car_variants.car_model_id', '=', 'car_models.id')
                ->join('used_cars', 'used_cars.car_variant_id', '=', 'car_variants.id')
                ->join('catalogues', 'catalogues.used_car_id', '=', 'used_cars.id')
                ->join('collections', 'collections.catalogue_id', '=', 'catalogues.id')
                ->where('collections.user_id', '=', auth()->id())
                ->get();
        // dd($collections);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        // dd($id);
        $collection = Collection::findOrFail($id);
        $collection->delete();

        return redirect()->route('collection.index');
    }


}
