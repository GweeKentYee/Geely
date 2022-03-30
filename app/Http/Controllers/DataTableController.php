<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarVariant;
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

    public function car(){

        $query = Car::select('*');

        return datatables($query)
            ->addIndexColumn()

            ->addColumn('File', function($query){

                $File = '<a href = "/admin/car/file/viewspec/'.$query->id.'">'.$query->spec_file.'</a><br>
                <a href = "/admin/car/file/viewdata/'.$query->id.'">'.$query->data_file.'</a>';

                return $File;

            })
            
            ->addColumn('Car_Model', function($query){

                $CarModel = $query->carModel->car_model;

                return $CarModel;

            })

            ->addColumn('Edit', function($query){

                $actionButton = '<a class= "btn btn-success btn-sm edit" href= "/admin/car/edit/'.$query->id.'">Edit</a>';
                
                return $actionButton;

            })
            
            ->addColumn('Delete', function($query){

                $actionButton = '<a class= "btn btn-danger btn-sm delete" href= "/admin/car/delete/'.$query->id.'">Delete</a>';
                
                return $actionButton;

            })->rawColumns(['File', 'Edit', 'Delete'])  // for columns which involve html codes
            ->make(true);
    }

    public function carbrand(){

        $query = CarBrand::select('*');

        return datatables($query)
            ->addIndexColumn()

            ->addColumn('Edit', function($query){

                $actionButton = '<a class= "btn btn-success btn-sm edit" href= "/admin/carbrand/edit/'.$query->id.'">Edit</a>';
                
                return $actionButton;

            })
            
            ->addColumn('Delete', function($query){

                $actionButton = '<a class= "btn btn-danger btn-sm delete" href= "/admin/carbrand/delete/'.$query->id.'">Delete</a>';
                
                return $actionButton;

            })->rawColumns(['Edit', 'Delete'])  // for columns which involve html codes
            ->make(true);
    }

    public function carmodel(){

        $query = CarModel::select('*');

        return datatables($query)
            ->addIndexColumn()

            ->addColumn('Car_Brand', function($query){

                $CarBrand = $query->carBrand->brand;

                return $CarBrand;

            })

            ->addColumn('Edit', function($query){

                $actionButton = '<a class= "btn btn-success btn-sm edit" href= "/admin/carmodel/edit/'.$query->id.'">Edit</a>';
                
                return $actionButton;

            })
            
            ->addColumn('Delete', function($query){

                $actionButton = '<a class= "btn btn-danger btn-sm delete" href= "/admin/carmodel/delete/'.$query->id.'">Delete</a>';
                
                return $actionButton;

            })->rawColumns(['Edit', 'Delete'])  // for columns which involve html codes
            ->make(true);
    }

    public function carvariant(){

        $query = CarVariant::select('*');

        return datatables($query)
            ->addIndexColumn()

            ->addColumn('Car_Brand', function($query){

                $CarBrand = $query->carBrand->brand;

                return $CarBrand;

            })

            ->addColumn('Edit', function($query){

                $actionButton = '<a class= "btn btn-success btn-sm edit" href= "/admin/carvariant/edit/'.$query->id.'">Edit</a>';
                
                return $actionButton;

            })
            
            ->addColumn('Delete', function($query){

                $actionButton = '<a class= "btn btn-danger btn-sm delete" href= "/admin/carvariant/delete/'.$query->id.'">Delete</a>';
                
                return $actionButton;

            })->rawColumns(['Edit', 'Delete'])  // for columns which involve html codes
            ->make(true);
    }

}
