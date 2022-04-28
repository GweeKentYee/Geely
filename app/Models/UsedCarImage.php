<?php

// This model file is used for interacting with the used_car_images table

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCarImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'used_car_id'
    ];

    // This model belongs to the UsedCar model
    public function usedCar()
    {
        return $this->belongsTo('App\Models\UsedCar', 'used_car_id');
    }
}
