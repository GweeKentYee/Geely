<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarVariant;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class DataTableController extends Controller
{
    //
    public function inspection(){

        $query = Inspection::select('*')->with('usedCar');

        return datatables($query)
            ->addIndexColumn()

            ->addColumn('File', function($query){

                $File = '<a href = "/admin/inspection/file/view/'.$query->id.'">'.$query->result_file.'</a>';

                return $File;

            })

            ->addColumn('Reg_Num', function($query){

                $Reg_Num = $query->usedCar->registration;

                return $Reg_Num;

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

            ->addColumn('Spec_File', function($query){

                if ($query->spec_file == null){

                    $specFile = '<i class="bi bi-eye-slash"></i>';

                } else {

                    $specFile = '<a href = "/admin/car/file/viewspec/'.$query->id.'" style="color: black"><i class="bi bi-eye-fill"></i></a>';
                }
                
                return $specFile;

            })

            ->addColumn('Data_File', function($query){

                $dataFile = '<a href = "/admin/car/file/viewdata/'.$query->id.'" style="color: black"><i class="bi bi-eye-fill"></i></a>';

                return $dataFile;

            })

            ->addColumn('Car_Brand', function($query){

                $CarBrand = $query->carVariant->carModel->carBrand->brand;

                return $CarBrand;

            })
            
            ->addColumn('Car_Model', function($query){

                $CarModel = $query->carVariant->carModel->model;

                return $CarModel;

            })

            ->addColumn('Car_Variant', function($query){

                $CarVariant = $query->carVariant->variant;

                return $CarVariant;

            })

            ->addColumn('Body_Type', function($query){

                $BodyType = $query->carBodyType->body_type;

                return $BodyType;

            })

            ->addColumn('Transmission', function($query){

                $Transmission = $query->carGeneralSpec->transmission;

                return $Transmission;

            })

            ->addColumn('Fuel', function($query){

                $Fuel = $query->carGeneralSpec->fuel;

                return $Fuel;

            })

            ->addColumn('Edit', function($query){

                $actionButton = '<a href= "/admin/car/edit/'.$query->id.'" style="color: blue"><i class="bi bi-pencil-square"></i></a>';
                
                return $actionButton;

            })
            
            ->addColumn('Delete', function($query){

                $actionButton = '<a class= "btn btn-danger btn-sm delete" href= "/admin/car/delete/'.$query->id.'"><i class="bi bi-trash"></i> Delete</a>';
                
                return $actionButton;

            })->rawColumns(['Spec_File', 'Data_File', 'Edit', 'Delete'])  // for columns which involve html codes
            ->make(true);
    }

    public function carbrand(){

        $query = CarBrand::select('*');

        return datatables($query)
            ->addIndexColumn()

            ->addColumn('Edit', function($query){

                $actionButton = '<a href= "/admin/carbrand/edit/'.$query->id.'" style="color: blue"><i class="bi bi-pencil-square"></i></a>';
                
                return $actionButton;

            })
            
            ->addColumn('Delete', function($query){

                $actionButton = '<a class= "btn btn-danger btn-sm delete" href= "/admin/carbrand/delete/'.$query->id.'"><i class="bi bi-trash"></i> Delete</a>';
                
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

                $actionButton = '<a href= "/admin/carmodel/edit/'.$query->id.'" style="color: blue"><i class="bi bi-pencil-square"></i></a>';
                
                return $actionButton;

            })
            
            ->addColumn('Delete', function($query){

                $actionButton = '<a class= "btn btn-danger btn-sm delete" href= "/admin/carmodel/delete/'.$query->id.'"><i class="bi bi-trash"></i> Delete</a>';
                
                return $actionButton;

            })->rawColumns(['Edit', 'Delete'])  // for columns which involve html codes
            ->make(true);
    }

    public function carvariant(){

        $query = CarVariant::select('*');

        return datatables($query)
            ->addIndexColumn()

            ->addColumn('Car_Model', function($query){

                $CarModel = $query->carModel->model;

                return $CarModel;

            })

            ->addColumn('Edit', function($query){

                $actionButton = '<a href= "/admin/carvariant/edit/'.$query->id.'" style="color: blue"><i class="bi bi-pencil-square"></i></a>';
                
                return $actionButton;

            })
            
            ->addColumn('Delete', function($query){

                $actionButton = '<a class= "btn btn-danger btn-sm delete" href= "/admin/carvariant/delete/'.$query->id.'"><i class="bi bi-trash"></i> Delete</a>';
                
                return $actionButton;

            })->rawColumns(['Edit', 'Delete'])  // for columns which involve html codes
            ->make(true);
    }
  
    public function newsletter(){

            $query = Newsletter::select('*');
              
             return datatables($query)
            ->addIndexColumn()

            ->addColumn('Link', function($query){

                $Link = '<a href = '.$query->link.'>'.$query->link.'</a>';

                return $Link;

            })

            ->addColumn('Image', function($query){

                $Image = '<a href = "/admin/newsletter/view/'.$query->id.'">'.$query->image.'</a>';

                return $Image;

            })


            ->addColumn('Action', function($query){

                $actionBtn = //'<a href = "/player/download/' .$query->JSON_file. '" class = "download btn btn-primary btn-sm">Download</a>
                                //'<a class = "btn btn-success btn-sm edit" href = "/allplayer/edit/'.$query->id.'">Edit</a>
                                '<a class= "btn btn-primary btn-sm details" href= "/admin/newsletter/edit/'.$query->id.'" >Edit</a>
                                <a class= "btn btn-danger btn-sm delete" href= "/admin/newsletter/delete/'.$query->id.'">Delete</a>'
                                ;
                return $actionBtn;

            })->rawColumns(['Image','Link','Action'])
            ->make(true);

    }
}
