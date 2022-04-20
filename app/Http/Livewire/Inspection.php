<?php

namespace App\Http\Livewire;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Inspection as ModelsInspection;
use App\Models\UsedCar;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Log;

class Inspection extends Component
{
    use WithFileUploads;
    public $CarBrands;
    public $cars;

    public $selectedBrand = NULL;

    public $reg_num;
    public $data_file;
    public $ownership_file;
    public $car;

    public function mount()
    {

        $this->CarBrands = CarBrand::all();
        $this->cars = collect();
    }

    public function updatedSelectedBrand($CarBrand)
    {

        if (!is_null($CarBrand)) {

            $CarModels = CarModel::select('id')->where('car_brand_id',$CarBrand)->get();

            $this->cars = Car::whereIn('car_model_id',$CarModels->pluck('id'))->with('carModel','carVariant','carBodyType','carGeneralSpec')->get();

        }

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            // 'car' => ['required', Rule::notIn('0')],
            'reg_num' => ['unique:used_cars,registration']
        ]);
    }

    public function newInspection()
    {
        $validatedData = $this->validate([
            'reg_num' => ['required','unique:used_cars,registration'],
            'data_file' => ['required'],
            'ownership_file' => ['required']
        ]);

        $usedFileName = $validatedData['data_file']->getClientOriginalName();

        $usedFilePath = $this->data_file->storeAs('storage/usedcar', $usedFileName);

        $ownershipFileName = $validatedData['ownership_file']->getClientOriginalName();

        $ownershipFilePath = $this->ownership_file->storeAs('storage/usedcar', $ownershipFileName);

        $UsedCar = UsedCar::create([
            'min_price' => 0,
            'max_price' => 0,
            'registration' => $validatedData['reg_num'],
            'data_file' => str_replace('\\','/',$usedFilePath),
            'ownership_file' => str_replace('\\','/',$ownershipFilePath),
            'status' => "0",
            'car_id' => 1,
        ]);

        //Inspection happen here
        //after inspection happen, a file will be generated

        $InspectionFilePath = $usedFilePath;

        ModelsInspection::create([
            'inspection_date' => now(),
            'result_file' => str_replace('\\','/',$InspectionFilePath),
            'used_car_id' => $UsedCar->id
        ]);

        return redirect('admin/inspection');
    }
}
