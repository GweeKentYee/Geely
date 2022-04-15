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
      $request->validate([
        'minimum_price'=>['required','integer'],
        'maximum_price'=>['required','integer'],
        'registration'=>['required','string'],
        'status'=>['required','numeric','between:1,3'],
        'car_id'=>['required','integer'],
        'data_file'=>['required','file'],
        'ownership_file'=>['required','file']

      ]);
        
        $usedCar = UsedCar::find($id);
        $usedCar->min_price = $request->input('minimum_price');
        $usedCar->max_price = $request->input('maximum_price');
        $usedCar->registration = $request->input('registration');
        $usedCar->status = $request->input('status');
        $usedCar->car_id = $request->input('car_id');
    if($request->hasfile('data_file'))
        {
          $destination = 'uploads\data_files\\'.$usedCar->data_file;
          if(File::exists($destination)){
            File::delete($destination);
          }
            $file = $request->file('data_file');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads\data_files',$filename);
            $usedCar->data_file = $filename;
            
        }
        if($request->hasfile('ownership_file'))
        {
          $destination = 'uploads\ownership_files\\'.$usedCar->data_file;
          if(File::exists($destination)){
            File::delete($destination);
          }
            $file = $request->file('ownership_file');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads\ownership_files',$filename);
            $usedCar->ownership_file = $filename;
            
        }
        $usedCar->update();

        return redirect("/admin/usedcar")->with('status','UsedCar Updated Successfully');
    }
}