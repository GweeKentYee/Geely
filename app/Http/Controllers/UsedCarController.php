<?php
namespace App\Http\Controllers;

use App\Models\UsedCar;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Inspection;
use NunoMaduro\Collision\Adapters\Laravel\Inspector;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use App\Models\Collection;
use Illuminate\Support\Facades\File;

class UsedCarController extends Controller
{

    public function viewdetailpage($used_car_id){

        $usedcar = UsedCar::find($used_car_id);
        $collections = Collection::all()->where('user_id',auth()->id());

        $Inspection = Inspection::select('result_file')->where('used_car_id', $used_car_id)->latest()->first();
        $File = public_path($Inspection->result_file);

        $reader = new ReaderXlsx();
        $spreadsheet = $reader->load($File);
        $sheet = $spreadsheet->getActiveSheet();

        $worksheetInfo = $reader->listWorksheetInfo($File);
        $Data = $sheet->toArray();


        return view('UsedCarDetails',
        ['usedcar' => $usedcar,  'collections'=> $collections, 'Data' => $Data]);
    }

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
