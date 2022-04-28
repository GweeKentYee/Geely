<?php

// This model file is used for interacting with the inspections table

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'inspection_date',
        'result_file',
        'used_car_id'
    ];

    // This model belongs to the UsedCar model
    public function usedCar()
    {
        return $this->belongsTo('App\Models\UsedCar', 'used_car_id');
    }

}
