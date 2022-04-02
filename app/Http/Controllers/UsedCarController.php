<?php

namespace App\Http\Controllers;
use App\Models\UsedCar;
use App\Models\UsedCarImage;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Editor\Fields\Select;

class UsedCarController extends Controller
{
    //
    public function viewAdminPage(){

       
        $usedcarCombined = UsedCar::join('used_car_images', 'used_cars.id', '=', 'used_car_images.used_car_id')
               ->get(['used_cars.min_price','used_cars.max_price','used_cars.registration','used_cars.data_file','used_cars.ownership_file','used_cars.status','used_cars.car_id','used_car_images.id', 'used_car_images.image']);
        $usedcar = UsedCar::all();
        return view('UsedCarDetails',compact('usedcarCombined'))->with('usedcar',$usedcar);

    }

    public function delete($id){
        usedcar::where('id',$id)->delete();
        return redirect()->back()->with('status','usedcar Deleted Successfully');
    }

    public function create(){
        $data = request()->validate([
            'usedcar'=>['required','unique:car_models,car_model']
        ]);
        usedcar::create([
            'car_model'=> $data['usedcar']
        ]);
        return redirect()->back()->with('status','usedcar Deleted Successfully');;
    }

    public function fetch($id){
    
        return usedcar::findOrFail($id);
    }

    public function edit($id){
    
        $usedcar = usedcar::find($id);
        return view('Editusedcar', compact('usedcar'));
    
    }

    public function update($id){

        $data = request()->validate([
            'usedcar-usedcar'=>['required','unique:car_models,car_model']
        ]);
        $usedcar = usedcar::find($id);
        $usedcar -> update([
            'car_model'=> $data['usedcar-usedcar']
        ]);

        return redirect("/admin/usedcar")->with('status','usedcar Updated Successfully');
    }
}
