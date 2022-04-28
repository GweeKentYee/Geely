<?php

// This controller was created for handling Used Car Image actions
// No special package used

namespace App\Http\Controllers;

use App\Models\UsedCarImage;
use App\Models\UsedCar;
use Illuminate\Http\Request;

class UsedCarImageController extends Controller
{
    // This function is used to ensure the users are authenticated to use this controller's function
    public function __construct()
    {
        $this->middleware('auth');
    }

    // This function is used to view the UsedCarImage page
    public function viewAdminPage($id){

        $usedCarImage = UsedCarImage::where('used_car_id',$id)->Paginate(8);
        $usedCar = UsedCar::find($id);

        return view('UsedCarImages',compact('usedCarImage','usedCar'));

    }

    // This function is used to add a new used car image
    public function store(Request $request){

         $request->validate([
           'Used_Car_Image'=>['required']
        ]);

        $usedCarId = $request->input('add-usedcarid');

        $usedCar = UsedCar::find($usedCarId);

        $files = $request->Used_Car_Image;

            foreach($files as $file){

                $extension = $file->getClientOriginalName();

                $filename = time().'.'.$extension;

                $filepath = $file->move('storage/image/usedcar/'.$usedCar->registration,$filename);

                UsedCarImage::create([
                    'image' => str_replace('\\','/',$filepath),
                    'used_car_id' => $usedCarId
                ]);

            }


        return redirect('admin/usedcar/images/'.$usedCarId);

    }

    // This function is used to delete selected used car image
    public function deleteSelected(Request $request, $usedcarID){

        $ids = $request->selected;

        foreach ($ids as $id) {

            $usedCarImage = UsedCarImage::findorfail($id);

            $ImageFilePath = str_replace('\\','/',public_path($usedCarImage->image));

            if(file_exists($ImageFilePath)){

                unlink($ImageFilePath);

            }

            $usedCarImage->delete();

        }

         return redirect('admin/usedcar/images/'.$usedcarID);

    }
}
