<?php

namespace App\Http\Controllers;

use App\Models\CarVariant;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CarVariantController extends Controller
{
    //
    public function viewAdminPage(){

        $CarModel = CarModel::all();

        return view('CarVariant',[
            'CarModel' => $CarModel
        ]);

    }

    public function delete($carvariantID){

        $CarVariant = CarVariant::find($carvariantID);

        unlink($CarVariant->specs_file);

        unlink($CarVariant->data_file);

        CarVariant::where('id', $carvariantID)->delete();

        return redirect('admin/carvariant');

    }

    public function addCarVariant(Request $request){

        $data = $request->validate([
            'car_model_id' => ['required'],
            'variant' => ['required', 
            Rule::unique('car_variants','variant')->where(function ($query){
                return $query->where('year', request('year'))->where('type', request('type'))->where('transmission', request('transmission'))->where('fuel', request('fuel'));
            })],
            'year' => ['required', Rule::notIn('0'), 
            Rule::unique('car_variants','year')->where(function ($query){
                return $query->where('variant', request('variant'))->where('type', request('type'))->where('transmission', request('transmission'))->where('fuel', request('fuel'));
            })],
            'type' => ['required', Rule::notIn('0'),
            Rule::unique('car_variants','type')->where(function ($query){
                return $query->where('variant', request('variant'))->where('year', request('year'))->where('transmission', request('transmission'))->where('fuel', request('fuel'));
            })],
            'transmission' => ['required', Rule::notIn('0'),
            Rule::unique('car_variants','transmission')->where(function ($query){
                return $query->where('variant', request('variant'))->where('year', request('year'))->where('type', request('type'))->where('fuel', request('fuel'));
            })],
            'fuel' => ['required', Rule::notIn('0'),
            Rule::unique('car_variants','fuel')->where(function ($query){
                return $query->where('variant', request('variant'))->where('year', request('year'))->where('type', request('type'))->where('transmission', request('transmission'));
            })],
            'specs_file' => ['required'],
            'data_file' => ['required']
        ]);

        $specsFileName = request()->file('specs_file')->getClientOriginalName();

        $specsFilePath = $data['specs_file']->move('storage/data/carvariant', $specsFileName);

        $dataFileName = request()->file('data_file')->getClientOriginalName();

        $dataFilePath = $data['data_file']->move('storage/data/carvariant', $dataFileName);

        CarVariant::create([
            'car_model_id' => $data['car_model_id'],
            'variant' => $data['variant'],
            'year' => $data['year'],
            'type' => $data['type'],
            'transmission' => $data['transmission'],
            'fuel' => $data['fuel'],
            'specs_file' => str_replace('\\', '/', $specsFilePath),
            'data_file' => str_replace('\\', '/', $dataFilePath)
        ]);

        return redirect('admin/carvariant');

    }

    public function viewSpecsFile($carvariantID){

        $CarVariant = CarVariant::find($carvariantID);

        $file = public_path($CarVariant->specs_file);

        return response()->download($file, '', [], 'inline');

    }

    public function viewDataFile($carvariantID){

        $CarVariant = CarVariant::find($carvariantID);

        $file = public_path($CarVariant->data_file);

        return response()->download($file, '', [], 'inline');

    }

    public function viewEditPage($carvariantID){

        $CarVariant = CarVariant::find($carvariantID);

        return view('EditCarVariant', [
            'CarVariant' => $CarVariant
        ]);

    }

    public function edit($carvariantID, Request $request){

        $CarVariant = CarVariant::find($carvariantID);

        $data = $request->validate([
            'variant' => [
            Rule::unique('car_variants','variant')->ignore($carvariantID)->where(function ($query){
                return $query->where('year', request('year'))->where('type', request('type'))->where('transmission', request('transmission'))->where('fuel', request('fuel'));
            })],
            'year' => [Rule::notIn('0'), 
            Rule::unique('car_variants','year')->ignore($carvariantID)->where(function ($query){
                return $query->where('variant', request('variant'))->where('type', request('type'))->where('transmission', request('transmission'))->where('fuel', request('fuel'));
            })],
            'type' => [Rule::notIn('0'),
            Rule::unique('car_variants','type')->ignore($carvariantID)->where(function ($query){
                return $query->where('variant', request('variant'))->where('year', request('year'))->where('transmission', request('transmission'))->where('fuel', request('fuel'));
            })],
            'transmission' => [Rule::notIn('0'),
            Rule::unique('car_variants','transmission')->ignore($carvariantID)->where(function ($query){
                return $query->where('variant', request('variant'))->where('year', request('year'))->where('type', request('type'))->where('fuel', request('fuel'));
            })],
            'fuel' => [Rule::notIn('0'),
            Rule::unique('car_variants','fuel')->ignore($carvariantID)->where(function ($query){
                return $query->where('variant', request('variant'))->where('year', request('year'))->where('type', request('type'))->where('transmission', request('transmission'));
            })],
            'specs_file' => []
        ]);

        // dd($data);

        $input = collect($data)->whereNotNull()->all();

        // dd($input);

        if(!empty($input)) {

            if(request('specs_file')){

                $inputWithoutFile = collect($data)->except('specs_file')->filter()->all();

                // dd($inputWithoutFile);

                unlink($CarVariant->specs_file); // call database column name

                $fileName = request()->file('specs_file')->getClientOriginalName();

                $filePath = $data['specs_file']->move('storage/data/carvariant',$fileName);

                $updateData = array_merge($inputWithoutFile, [
                    'specs_file' => str_replace('\\','/',$filePath)
                ]);

                $CarVariant->update($updateData);

                return redirect('admin/carvariant');

            } else {

                $CarVariant->update($input);

                return redirect('admin/carvariant');

            }

        } else {

            Session::flash('field_empty', 'Please fill in at least one field.');

            return redirect('admin/carvariant/edit/'.$carvariantID);

        }

    }

}
