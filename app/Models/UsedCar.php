<?php

// This model file is used for interacting with the used_cars table

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'min_price',
        'max_price',
        'registration',
        'data_file',
        'ownership_file',
        'status',
        'car_id'
    ];

    // This model has a one-to-many relationship with the Inspection model
    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    // This model has a one-to-many relationship with the UsedCarImage model
    public function usedCarImages()
    {
        return $this->hasMany(UsedCarImage::class);
    }

    // This model has a one-to-many relationship with the Collection model
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    // This model belongs to the Car model
    public function car()
    {
        return $this->belongsTo('App\Models\Car', 'car_id');
    }

}
