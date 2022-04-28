<?php

// This model file is used for interacting with the car_variants table

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
        'variant',
        'car_model_id'
    ];

    // This model has a one-to-many relationship with the Car model
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    // This model belongs to the CarModel model
    public function carModel()
    {
        return $this->belongsTo('App\Models\CarModel', 'car_model_id');
    }

}
