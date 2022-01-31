<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    use HasFactory;

    public function usedcar(){
        return $this -> belongsTo(UsedCar::class,'used_car_id');
    }
}
