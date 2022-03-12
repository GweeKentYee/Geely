<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use App\Models\UsedCar;
use Illuminate\Http\Request;

class DataTableController extends Controller
{

    public function carmodel(){

        $query = CarModel::select('*');

        return datatables($query)
            ->addIndexColumn()
                ->addColumn('Action', function($query){

                    $actionBtn = '<a class = "btn btn-primary btn-sm detail" data-bs-toggle="modal" data-bs-target="#carmodeldetails" data-id="'.$query->id.'">Details</a>
                                    <a class = "btn btn-success btn-sm edit" href = "/carmodel/edit/'.$query->id.'" >Edit</a>
                                    <a class= "btn btn-danger btn-sm delete" href = "/carmodel/delete/'.$query->id.' ">Delete</a>'
                                    ;
                    return $actionBtn;

                })->rawColumns(['Action'])
                ->make(true);

    }
    public function usedcar(){

        $query = UsedCar::select('*');

        return datatables($query)
            ->addIndexColumn()
                ->addColumn('Action', function($query){

                    $actionBtn = '<a class = "btn btn-primary btn-sm detail" data-bs-toggle="modal" data-bs-target="#usedcardetails" usedcar-data-id="'.$query->id.'">Details</a>
                                    <a class = "btn btn-success btn-sm edit" href = "/usedcar/edit/'.$query->id.'" >Edit</a>
                                    <a class= "btn btn-danger btn-sm delete" href="/usedcar/delete/'.$query->id.'" >Delete</a>'
                                    ;
                    return $actionBtn;

                })->rawColumns(['Action'])
                ->make(true);

    }
}
