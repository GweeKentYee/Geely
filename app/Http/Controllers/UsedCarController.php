<?php
namespace App\Http\Controllers;

use App\Models\UsedCar;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UsedCarController extends Controller
{
    //
    public function viewAdminPage(){

        $car_id = Car::all();
        return view('UsedCar')->with('car_id',$car_id);

    }

    public function delete($id){
  
        $usedCar = UsedCar::findorfail($id);
        $filename = $usedCar->data_file;
        $path= public_path('uploads\data_files\\'.$filename);
        File::delete($path);
        $filename = $usedCar->ownership_file;
        $path= public_path('uploads\ownership_files\\'.$filename);
        File::delete($path);
        $usedCar->delete();
        return redirect()->back()->with('status','UsedCar Deleted Successfully');
    }

    public function fetch($id){

        return UsedCar::findOrFail($id);

    }

    public function edit($id){
        $car_id = Car::all();
        $UsedCar = UsedCar::find($id);
        return view('EditUsedCar', compact('UsedCar'))->with('car_id',$car_id);

    }

    public function update($id,Request $request){
      $data =request()->validate([
        'minimum_price'=>['numeric','lt:maximum_price'],
        'maximum_price'=>['numeric','gt:minimum_price'],
        'status_'=>['numeric','between:1,3'],
        'ownership_file'=>['file']

      ]);
        
        $usedCar = UsedCar::find($id);
        
          $usedCar->min_price = $data['minimum_price'];
          $usedCar->max_price = $data['maximum_price'];
          $usedCar->status = $data['status_'];
        if($request->hasfile('ownership_file'))
        {
          $file = $request->file('ownership_file');
          $extension = $file->getClientOriginalExtension();
          $filename = time().'_ownership.'.$extension;
          $file->move('storage/data/used_car/'.$usedCar->registration.'/',$filename);
          $usedCar->ownership_file = $filename;
            
        }
        $usedCar->update();

        return redirect("/admin/usedcar")->with('status','UsedCar Updated Successfully');
    }
}