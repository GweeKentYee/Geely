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

    public function index()
    {

        $collections= Collection::where('user_id','=',auth()->id())->get();

        return view('Collection', ['collections' => $collections]);
    }

    public function viewdetailpage($used_car_id){

        $usedcar = UsedCar::find($used_car_id);

        $collections = Collection::all()->where('user_id',auth()->id());

        return view('UsedCarDetails',
        ['usedcar' => $usedcar, 'collections'=> $collections]);
    }

    public function store(Request $request)
    {
        $collection = new Collection();
        $collection->used_car_id = $request->input("usedcar_id");
        $collection->user_id = auth()->id();
        $collection->save();

        return redirect()->route('catalogue.viewpage');
    }

    public function CarDetailsStore(Request $request)
    {
        $collection = new Collection();
        $collection->used_car_id = $request->input("usedcar_id");
        $collection->user_id = auth()->id();
        $collection->save();

        return redirect('cardetails/'.$request->input("usedcar_id"));
    }

    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);
        $collection->delete();

        return redirect()->route('collection.index');
    }


}
