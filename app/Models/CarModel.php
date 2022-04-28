<?php

// This model file is used for interacting with the car_models table

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'model',
        'car_brand_id'
    ];

    // This model belongs to the CarBrand model
    public function carBrand()
    {
        return $this->belongsTo('App\Models\CarBrand', 'car_brand_id');
    }

    // This model has a one-to-many relationship with the CarVariant model
    public function carVariants()
    {
        return $this->hasMany(CarVariant::class);
    }

}
