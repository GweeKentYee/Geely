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
        'variant',
        'car_model_id'
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function carModel()
    {
        return $this->belongsTo('App\Models\CarModel', 'car_model_id');
    }

}