<?php

// This model file is used for interacting with the collections table

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'used_car_id',
        'user_id',
    ];

    // This model belongs to the UsedCar model
    public function usedCar()
    {
        return $this->belongsTo('App\Models\UsedCar', 'used_car_id');
    }

    // This model belongs to the User model
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
