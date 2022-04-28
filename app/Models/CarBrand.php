<?php

// This model file is used for interacting with the car_brands table

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand'
    ];

    // This model has a one-to-many relationship with the CarModel model
    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }

}
