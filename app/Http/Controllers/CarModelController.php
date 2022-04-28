<?php

// This controller was created for handling Car Model actions
// No special package used

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarModelController extends Controller
{
    // This function is used to ensure the users are authenticated to use this controller's function
    public function __construct()
    {
        $this->middleware('auth');
    }

    // This function is used for adding new car model
    public function addCarModel(Request $request){

        // validate inputed records according to columns of the database table
        $validator = Validator::make($request->all(), [
            'car_brand' => ['required', Rule::notIn('0')],
            'model' => ['required',
            Rule::unique('car_models','model')->where(function ($query){
                return $query->where('car_brand_id', request('car_brand'));
            })]
        ]);

        if ($validator->fails()) {
            return redirect('admin/brand_model_variant')
                        ->withErrors($validator)
                        ->withInput(['tab'=>'carmodeltab'])
                        ->with('error_code', 2);
        }

        $data = $validator->validated();

        // create new records
        CarModel::create([
            'car_brand_id' => $data['car_brand'],
            'model' => $data['model']
        ]);

        return redirect('admin/brand_model_variant')->withInput(['tab'=>'carmodeltab']);

    }

    // This function is used to view the Edit CarModel page
    public function viewEditPage($carmodelID){

        $CarModel = CarModel::find($carmodelID);  // use CarModel model to find records of a specific Car Model ID

        $CarBrand = CarBrand::all();  // use CarBrand model to retrieve all records

        return view('EditCarModel', [
            'CarModel' => $CarModel,
            'CarBrand' => $CarBrand
        ]);

    }

    // This function is used to edit an existing car model record
    public function edit($carmodelID, Request $request){

        $CarModel = CarModel::find($carmodelID);  // use CarModel model to find records of a specific Car Model ID

        // validate edited records according to columns of the database table
        $data = $request->validate([
            'model' => [
            Rule::unique('car_models','model')->ignore($carmodelID)->where(function ($query) use($CarModel){
                return $query->where('car_brand_id', $CarModel->car_brand_id);
            })]
        ]);

        $input = collect($data)->whereNotNull()->all();  // to filter out empty fields

        if(!empty($input)) {

            $CarModel->update($input);

            return redirect('admin/brand_model_variant')->withInput(['tab'=>'carmodeltab']);

        } else {

            Session::flash('field_empty', 'Please fill in at least one field.');

            return redirect('admin/carmodel/edit/'.$carmodelID);

        }

    }

    // This function is used to delete an existing car model record
    public function delete($carmodelID){

        CarModel::where('id', $carmodelID)->delete();

        return redirect('admin/brand_model_variant')->withInput(['tab'=>'carmodeltab']);

    }

}
