<?php

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

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function carBrand()
    {
        return $this->belongsTo('App\Models\CarBrand', 'car_brand_id');
    }
}
