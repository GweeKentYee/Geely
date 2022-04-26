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
use Illuminate\Support\Facades\Session;


class UsedCarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewdetailpage($used_car_id){

        $usedcar = UsedCar::find($used_car_id);

        $collections = Collection::all()->where('user_id',auth()->id());

        $Inspection = Inspection::select('result_file')->where('used_car_id', $used_car_id)->latest()->first();

        $File = public_path($Inspection->result_file);

        $reader = new ReaderXlsx();
        $spreadsheet = $reader->load($File);
        $sheet = $spreadsheet->getActiveSheet();

        $Data = $sheet->toArray();

        return view('UsedCarDetails',[
            'usedcar' => $usedcar,
            'collections'=> $collections,
            'Data' => $Data
        ]);
    }

    public function viewAdminPage(){

        $car_id = Car::all();

        return view('UsedCar')->with('car_id',$car_id);

    }

    public function delete($id){

        $usedCar = UsedCar::findorfail($id);

        $usedCarFolder = public_path('storage/data/usedcar/'.$usedCar->registration);

        File::deleteDirectory($usedCarFolder);

        $usedCar->delete();

        return redirect("/admin/usedcar");

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

            'min_price'=>['nullable','numeric','lt:max_price'],
            'max_price'=>['nullable','numeric','gt:min_price'],
            'status'=>['numeric','between:0,2'],
            'ownership_file'=>['file']

        ]);

        $usedCar = UsedCar::find($id);

        $input = collect($data)->whereNotNull()->all();

        if(!empty($input)) {

            if(request('ownership_file'))
            {
                $inputWithoutFile = collect($data)->except(['ownership_file'])->filter()->all();

                $ownership_file = $request->file('ownership_file');

                $extension = $ownership_file->getClientOriginalExtension();

                $ownership_filename = time().'_ownership.'.$extension;

                $new_ownership_FilePath = $ownership_file->move('storage/data/used_car/'.$usedCar->registration.'/',$ownership_filename);

                $old_ownership_FilePath = str_replace('\\','/',public_path($usedCar->ownership_file));

                if(file_exists($old_ownership_FilePath)){

                    unlink($old_ownership_FilePath);

                }

                $updateData = array_merge($inputWithoutFile, [
                    'ownership_file' => str_replace('\\','/',$new_ownership_FilePath),
                ]);

                $usedCar->update($updateData);

            } else {

                $usedCar->update($input);

            }

            return redirect('admin/usedcar');

        } else {

            Session::flash('field_empty', 'Please fill in at least one field.');

            return redirect('admin/usedcar/edit/'.$id);

        }

        return redirect("/admin/usedcar");

    }

    public function viewDataFile($id){

        $UsedCar = UsedCar::find($id);

        $file = public_path($UsedCar->data_file);

        return response()->download($file,'',[],'inline');

    }

    public function viewOwnershipFile($id){

        $UsedCar = UsedCar::find($id);

        $file = public_path($UsedCar->ownership_file);

        return response()->download($file,'',[],'inline');

    }
}
