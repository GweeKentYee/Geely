<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarVariant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'year',
        'variant',
        'type',
        'transmission',
        'fuel',
        'specs_file',
        'data_file',
        'car_model_id'
    ];

    public function usedCars()
    {
        return $this->hasMany(UsedCar::class);
    }

    public function carModel()
    {
        return $this->belongsTo('App\Models\CarModel', 'car_model_id');
    }

}
