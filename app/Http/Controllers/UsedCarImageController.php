<?php

namespace App\Http\Controllers;

use App\Models\UsedCarImage;
use App\Models\UsedCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UsedCarImageController extends Controller
{
  public function viewAdminPage($id){

    $usedCarImage = UsedCarImage::where('used_car_id',$id)->simplePaginate(9);
    $usedCar = UsedCar::find($id);
    return view('UsedCarImages',compact('usedCarImage','usedCar'));

}

    public function store(Request $request)
    {
      
         $request->validate([
           'Used_Car_Image'=>['required']

           ]);

            $files = $request->Used_Car_Image;
            foreach($files as $file){
            $extension = $file->getClientOriginalName();
            $filename = time().'.'.$extension;
            $file->move('uploads\usedcarimage',$filename);
            $usedCarImage = new UsedCarImage;
            $usedCarImage->used_car_id = $request->input('add-usedcarid');
            $usedCarImage->image = $filename;
            $usedCarImage->save();
            }
        
        
        return redirect()->back()->with('status','Used Car Image Added Succesfully');

    }
    
    public function delete($id){
      $usedCar = UsedCarImage::findorfail($id);
      $filename = $usedCar->image;
      $path= public_path('uploads\usedcarimage\\'.$filename);
      File::delete($path);
      $usedCar->delete();
      return redirect()->back()->with('status','Used Car Image Deleted Successfully');
  }

    public function deleteSelected(Request $request){
     
      $ids = $request->selected;
      foreach ($ids as $id) {  
        $usedCar = UsedCarImage::findorfail($id);     
        $filename = $usedCar->image;
        $userPhoto = public_path('uploads\usedcarimage\\'.$filename);
        File::delete($userPhoto);
        $usedCar->delete();  
     }
      return redirect()->back()->with('status','Used Car Image Deleted Successfully');
  }
    }
