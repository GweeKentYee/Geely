<?php

namespace App\Http\Controllers;

use App\Models\UsedCarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UsedCarImageController extends Controller
{

    public function store(Request $request)
    {
        $usedCarImage = new UsedCarImage;
        $usedCarImage->used_car_id = $request->input('add-usedcarid');
        if($request->hasfile('add-usedcarImage'))
        {
            $file = $request->file('add-usedcarImage');
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
    return view('EditUsedCar', compact('usedCarImage'));

}
public function update(Request $request,$id){

  $usedCarImagerecord = UsedCarImage::find($id);
  if($request->hasfile('usedcarImage-image'))
        {
          $destination = 'uploads\usedcarimage\\'.$usedCarImagerecord->image;
          if(File::exists($destination)){
            File::delete($destination);
          }
            $file = $request->file('usedcarImage-image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads\usedcarimage',$filename);
            $usedCarImagerecord->image = $filename;
            
        }
        $usedCarImagerecord->update();


  return redirect("/admin/usedcar")->with('status','Used Car Image Updated Successfully');
}
    }
