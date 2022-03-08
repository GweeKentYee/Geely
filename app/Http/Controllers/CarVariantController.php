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

        CarVariant::where('id', $carvariantID)->delete();

        return redirect('admin/carvariant');

    }

    public function addCarVariant(Request $request){

        $data = $request->validate([
            'car_model_id' => ['required'],
            'variant' => ['required', 
            Rule::unique('car_variants','variant')->where(function ($query){
                return $query->where('year', request('year'))->where('type', request('type'));
            })],
            'year' => ['required', Rule::notIn('0'), 
            Rule::unique('car_variants','year')->where(function ($query){
                return $query->where('variant', request('variant'))->where('type', request('type'));
            })],
            'type' => ['required', Rule::notIn('0'),
            Rule::unique('car_variants','type')->where(function ($query){
                return $query->where('variant', request('variant'))->where('year', request('year'));
            })],
            'data_file' => ['required']
        ]);

        $variantFileName = request()->file('data_file')->getClientOriginalName();

        $variantFilePath = $data['data_file']->move('storage/data/carvariant', $variantFileName);

        CarVariant::create([
            'car_model_id' => $data['car_model_id'],
            'variant' => $data['variant'],
            'year' => $data['year'],
            'type' => $data['type'],
            'file' => str_replace('\\', '/', $variantFilePath)
        ]);

        return redirect('admin/carvariant');

    }

    public function viewCarVariantFile($carvariantID){

        $CarVariant = CarVariant::find($carvariantID);

        $file = public_path($CarVariant->file);

        return response()->download($file, '', [], 'inline');

    }

    public function viewEditPage($carvariantID){

        $CarVariant = CarVariant::find($carvariantID);

        return view('EditCarVariant', [
            'car_variant' => $CarVariant
        ]);

    }

    public function edit($carvariantID, Request $request){

        $data = $request->validate([
            'variant' => [
            Rule::unique('car_variants','variant')->ignore($carvariantID)->where(function ($query){
                return $query->where('year', request('year'))->where('type', request('type'));
            })],
            'year' => [Rule::notIn('0'), 
            Rule::unique('car_variants','year')->ignore($carvariantID)->where(function ($query){
                return $query->where('variant', request('variant'))->where('type', request('type'));
            })],
            'type' => [Rule::notIn('0'),
            Rule::unique('car_variants','type')->ignore($carvariantID)->where(function ($query){
                return $query->where('variant', request('variant'))->where('year', request('year'));
            })],
            'data_file' => []
        ]);

        // dd($data);

        $CarVariant = CarVariant::find($carvariantID);

        $input = collect($data)->whereNotNull()->all();

        // dd($input);

        if(!empty($input)) {

            if(request('data_file')){

                $inputWithoutFile = collect($data)->except('data_file')->filter()->all();

                // dd($inputWithoutFile);

                unlink($CarVariant->file); // call database column name

                $filename = request()->file('data_file')->getClientOriginalName();

                $filepath = $data['data_file']->move('storage/data/carvariant',$filename);

                $updatedata = array_merge($inputWithoutFile, [
                    'file' => str_replace('\\','/',$filepath)
                ]);

                $CarVariant->update($updatedata);

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
