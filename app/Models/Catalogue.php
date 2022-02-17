<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
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
        'used_car_id'
    ];

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function usedCar()
    {
        return $this->belongsTo('App\Models\UsedCar', 'used_car_id');
    }
}
