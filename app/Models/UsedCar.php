<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCar extends Model
{
    use HasFactory;

    public function catalogue()
    {
        return $this->hasOne(Catalogue::class);
    }

    public function carmodel()
    {
        return $this->belongsTo(CarModel::class,'car_model_id');
    }
}
