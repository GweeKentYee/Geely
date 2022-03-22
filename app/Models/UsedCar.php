<?php

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

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function usedCarImages()
    {
        return $this->hasMany(UsedCarImage::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function car()
    {
        return $this->belongsTo('App\Models\Car', 'car_id');
    }

}
