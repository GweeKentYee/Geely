<?php

// This model file is used for interacting with the car_body_types table

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBodyType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'body_type'
    ];

    // This model has a one-to-many relationship with Car model
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
