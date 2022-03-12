<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function viewAdminPage(){

        return view('CarModel');

    }

    public function delete($id){
        CarModel::where('id',$id)->delete();
        return redirect()->back()->with('status','Carmodel Deleted Successfully');
    }

    public function create(){
        $data = request()->validate([
            'carmodel'=>['required','unique:car_models,car_model']
        ]);
        CarModel::create([
            'car_model'=> $data['carmodel']
        ]);
        return redirect()->back()->with('status','Carmodel Deleted Successfully');;
    }

    public function fetch($id){
    
        return CarModel::findOrFail($id);
    }

    public function edit($id){
    
        $carmodel = CarModel::find($id);
        return view('EditCarModel', compact('carmodel'));
    
    }

    public function update($id){

        $data = request()->validate([
            'carmodel-carmodel'=>['required','unique:car_models,car_model']
        ]);
        $CarModel = CarModel::find($id);
        $CarModel -> update([
            'car_model'=> $data['carmodel-carmodel']
        ]);

        return redirect("/admin/carmodel")->with('status','Carmodel Updated Successfully');
    }
}
