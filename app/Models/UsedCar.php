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
        'file',
        'status',
        'car_variant_id'
    ];

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function catalogue()
    {
        return $this->hasOne(Catalogue::class);
    }

    public function carVariant()
    {
        return $this->belongsTo('App\Models\CarVariant', 'car_variant_id');
    }

}
