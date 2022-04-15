<?php

namespace App\Http\Controllers;

use App\Models\UsedCarImage;
use App\Models\UsedCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UsedCarImageController extends Controller
{
  public function viewAdminPage($id){

    $usedcarCombined = UsedCar::join('used_car_images', 'used_cars.id', '=', 'used_car_images.used_car_id')
           ->where(['used_cars.id' => $id])
           ->get(['used_cars.min_price','used_cars.max_price','used_cars.registration','used_cars.data_file','used_cars.ownership_file','used_cars.status','used_cars.car_id','used_car_images.id', 'used_car_images.image','used_car_images.used_car_id']);
    return view('UsedCarDetails',compact('usedcarCombined'));

}

    public function store(Request $request)
    {
      
         $request->validate([
           'Used_Car_Image'=>['required','file']

           ]);
         
        $usedCarImage = new UsedCarImage;
        $usedCarImage->used_car_id = $request->input('add-usedcarid');
        if($request->hasfile('Used_Car_Image'))
        {
            $file = $request->file('Used_Car_Image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads\usedcarimage',$filename);
            $usedCarImage->image = $filename;
        }
        $usedCarImage->save();
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
  public function edit($id){
    
    $usedCarImage = UsedCarImage::find($id);
    return view('EditUsedCarDetails',compact('usedCarImage'));

}
public function update(Request $request,$id){

  $request->validate([
    'Used_Car_Image'=>['required','file']

  ]);
  $usedCarImagerecord = UsedCarImage::find($id);
  if($request->hasfile('Used_Car_Image'))
        {
          $destination = 'uploads\usedcarimage\\'.$usedCarImagerecord->image;
          if(File::exists($destination)){
            File::delete($destination);
          }
            $file = $request->file('Used_Car_Image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads\usedcarimage',$filename);
            $usedCarImagerecord->image = $filename;
            
        }
        $usedCarImagerecord->update();


  return redirect("/admin/usedcar")->with('status','Used Car Image Updated Successfully');
  }
    }
