<?php

namespace App\Http\Controllers;

use App\Models\UsedCarImage;
use App\Models\UsedCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UsedCarImageController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }

  public function viewAdminPage($id){

    $usedCarImage = UsedCarImage::where('used_car_id',$id)->simplePaginate(8);
    $usedCar = UsedCar::find($id);
    return view('UsedCarImages',compact('usedCarImage','usedCar'));

}

    public function store(Request $request)
    {
      
         $request->validate([
           'Used_Car_Image'=>['required']

           ]);
           $usedCarId = $request->input('add-usedcarid');
           $usedCar = UsedCar::find($usedCarId);
            $files = $request->Used_Car_Image;
            foreach($files as $file){
            $extension = $file->getClientOriginalName();
            $filename = time().'.'.$extension;
            $file->move('storage/image/used_car/'.$usedCar->registration,$filename);
            $usedCarImage = new UsedCarImage;
            $usedCarImage->used_car_id = $request->input('add-usedcarid');
            $usedCarImage->image = $filename;
            $usedCarImage->save();
            }
        
        
        return redirect()->back()->with('status','Used Car Image Added Succesfully');

    }
    
    public function deleteSelected(Request $request){
     
      $ids = $request->selected;
      foreach ($ids as $id) {  
        $usedCarImage = UsedCarImage::findorfail($id);
        $usedCar = UsedCar::find($usedCarImage->used_car_id);     
        $filename = $usedCarImage->image;
        $userPhoto = public_path('storage/image/used_car/'.$usedCar->registration.'/'.$filename);
        File::delete($userPhoto);
        $usedCarImage->delete();  
     }
      return redirect()->back()->with('status','Used Car Image Deleted Successfully');
  }
    }
