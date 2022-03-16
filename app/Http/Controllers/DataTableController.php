<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Catalogue;
use Illuminate\Http\Request;

class DataTableController extends Controller
{
    //
    public function inspection(){
        $query = Inspection::select('*');
        
        return datatables($query)
            ->addIndexColumn()

            ->addColumn('File', function($query){

                $File = '<a href = "/admin/inspection/file/view/'.$query->id.'">'.$query->result_file.'</a>';

                return $File;

            })

            ->addColumn('Car_Model', function($query){

                $CarModel = $query->usedCar->car->carModel->car_model;

                return $CarModel;

            })

            ->addColumn('Action', function($query){

                $actionBtn = //'<a href = "/player/download/' .$query->JSON_file. '" class = "download btn btn-primary btn-sm">Download</a>
                                //'<a class = "btn btn-success btn-sm edit" href = "/allplayer/edit/'.$query->id.'">Edit</a>
                                '<a class= "btn btn-primary btn-sm details" href= "/admin/inspection/details/'.$query->id.'" >Details</a>
                                <a class= "btn btn-danger btn-sm delete" href= "/admin/inspection/delete/'.$query->id.'">Delete</a>'
                                ;
                return $actionBtn;

            })->rawColumns(['File','Action'])
            ->make(true);

    }
}
