<?php

// This model file is used for interacting with the cars table

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_variant_id',
        'car_body_type_id',
        'car_general_spec_id',
        'year',
        'spec_file',
        'data_file'
    ];

    // This model belongs to the CarVariant model
    public function carVariant()
    {
        return $this->belongsTo('App\Models\CarVariant', 'car_variant_id');
    }

    // This model belongs to the CarBodyType model
    public function carBodyType()
    {
        return $this->belongsTo('App\Models\CarBodyType', 'car_body_type_id');
    }

    // This model belongs to the CarGeneralSpec model
    public function carGeneralSpec()
    {
        return $this->belongsTo('App\Models\CarGeneralSpec', 'car_general_spec_id');
    }

    public $timestamps = false;

}
