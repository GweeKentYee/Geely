<?php

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

    public function carVariant()
    {
        return $this->belongsTo('App\Models\CarVariant', 'car_variant_id');
    }

    public function carBodyType()
    {
        return $this->belongsTo('App\Models\CarBodyType', 'car_body_type_id');
    }

    public function carGeneralSpec()
    {
        return $this->belongsTo('App\Models\CarGeneralSpec', 'car_general_spec_id');
    }

    public $timestamps = false;

}
