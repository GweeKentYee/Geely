<?php

namespace App\Http\Controllers;

use App\Models\UsedCar;
use App\Models\CarVariant;
use Illuminate\Http\Request;

class UsedCarController extends Controller
{
    //
    public function viewAdminPage(){

        $carvariant = CarVariant::all();
        return view('UsedCarDetails')->with('carvariantid',$carvariant);

    }

    public function delete($id){
        UsedCar::where('id',$id)->delete();
        return redirect()->back()->with('status','UsedCar Deleted Successfully');
    }

    public function create(Request $request){
        $data = request()->validate([
            'add-file'=>['required','unique:used_cars,file'],
            'add-status'=>['required','unique:used_cars,status'],
            'add-car_variant_id'=>['unique:used_cars,car_variant_id']
            
        ]);
         
        UsedCar::create([
            'file'=> $data['add-file'],
            'status'=> $data['add-status'],
            'car_variant_id'=> $data['add-car_variant_id']
        ]);
        return redirect()->back()->with('status','UsedCar added Successfully');
        
    }

    public function fetch($id){
        
        return UsedCar::findOrFail($id);
        
    }

    public function edit($id){
        $carvariant = CarVariant::all();
        $UsedCar = UsedCar::find($id);
        return view('EditUsedCar', compact('UsedCar'))->with('carvariantid',$carvariant);
    
    }

    public function update($id,Request $request){
        
        $data = request()->validate([
            'usedcar-file'=>['required','unique:used_cars,file'],
            'usedcar-status'=>['required','unique:used_cars,status'],
            'edit-car_variant_id'=>['required','unique:used_cars,car_variant_id']
        ]); 
        
        $UsedCar = UsedCar::find($id);
        $UsedCar -> update([
            'file'=> $data['usedcar-file'],
            'status'=> $data['usedcar-status'],
            'car_variant_id'=> $data['edit-car_variant_id']
        ]);

        return redirect("/admin/usedcar")->with('status','UsedCar Updated Successfully');
    }
}
