<?php

// This model file is used for interacting with the car_general_specs table

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarGeneralSpec extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fuel',
        'transmission'
    ];

    // This model has a one-to-many relationship with the Car model
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
