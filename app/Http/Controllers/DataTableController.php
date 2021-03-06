<?php

// This controller was created for handling DataTable actions
// Package: composer require yajra/laravel-datatables:^1.5
// https://github.com/yajra/laravel-datatables

// All the functions created in this controller use the package

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\UsedCar;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarVariant;
use App\Models\Newsletter;

use Illuminate\Http\Request;

class DataTableController extends Controller
{
    // This function is used to generate the Inspection DataTable
    public function inspection(){

        $query = Inspection::select('*')->with('usedCar');

        return datatables($query)
            ->addIndexColumn()

            ->addColumn('File', function($query){

                $File = '<a href = "/admin/inspection/file/view/'.$query->id.'" style="color: blue; font-size: 18px"><i class="bi bi-download"></i></a>';

                return $File;

            })

            ->addColumn('Reg_Num', function($query){

                $Reg_Num = $query->usedCar->registration;

                return $Reg_Num;

            })

            ->addColumn('Details', function($query){

                $actionBtn = '<a class= "btn btn-primary btn-sm details" href= "/admin/inspection/details/'.$query->id.'"><i class="bi bi-info-circle"></i> Details</a>';

                return $actionBtn;

            })

            ->addColumn('Delete', function($query){

                $actionBtn = '<a class= "btn btn-danger btn-sm delete" href= "/admin/inspection/delete/'.$query->id.'"><i class="bi bi-trash"></i> Delete</a>';

                return $actionBtn;

            })->rawColumns(['File','Details','Delete'])
            ->make(true);
    }

    // This function is used to generate the Car DataTable
    public function car(){

        $query = Car::select('*');

        return datatables($query)
            ->addIndexColumn()

            ->addColumn('Spec_File', function($query){

                if ($query->spec_file == null){

                    $specFile = '<span style="font-size: 16px"><i class="bi bi-eye-slash"></i></span>';

                } else {

                    $specFile = '<a href = "/admin/car/file/viewspec/'.$query->id.'" style="color: black; font-size: 16px" target="_blank"><i class="bi bi-eye-fill"></i></a>';
                }

                return $specFile;

            })

            ->addColumn('Data_File', function($query){

                $dataFile = '<a href = "/admin/car/file/viewdata/'.$query->id.'" style="color: blue; font-size: 18px"><i class="bi bi-download"></i></a>';

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

                $actionButton = '<a href= "/admin/car/edit/'.$query->id.'" style="color: blue; font-size: 16px"><i class="bi bi-pencil-square"></i></a>';

                return $actionButton;

            })

            ->addColumn('Delete', function($query){


                $actionButton = '<a class= "btn btn-danger btn-sm delete" href= "/admin/car/delete/'.$query->id.'"><i class="bi bi-trash"></i> Delete</a>';

                return $actionButton;

            })->rawColumns(['Spec_File', 'Data_File', 'Edit', 'Delete'])  // for columns which involve html codes
            ->make(true);
    }

    // This function is used to generate the Car Brand DataTable
    public function carbrand(){

        $query = CarBrand::select('*');

        return datatables($query)
            ->addIndexColumn()

            ->addColumn('Edit', function($query){

                $actionButton = '<a href= "/admin/carbrand/edit/'.$query->id.'" style="color: blue; font-size: 16px"><i class="bi bi-pencil-square"></i></a>';

                return $actionButton;

            })

            ->addColumn('Delete', function($query){

                $actionButton = '<a class= "btn btn-danger btn-sm delete" href= "/admin/carbrand/delete/'.$query->id.'"><i class="bi bi-trash"></i> Delete</a>';

                return $actionButton;

            })->rawColumns(['Edit', 'Delete'])  // for columns which involve html codes
            ->make(true);
    }

    // This function is used to generate the Car Model DataTable
    public function carmodel(){

        $query = CarModel::select('*');

        return datatables($query)
            ->addIndexColumn()

            ->addColumn('Car_Brand', function($query){

                $CarBrand = $query->carBrand->brand;

                return $CarBrand;

            })

            ->addColumn('Edit', function($query){

                $actionButton = '<a href= "/admin/carmodel/edit/'.$query->id.'" style="color: blue; font-size: 16px"><i class="bi bi-pencil-square"></i></a>';

                return $actionButton;

            })

            ->addColumn('Delete', function($query){

                $actionButton = '<a class= "btn btn-danger btn-sm delete" href= "/admin/carmodel/delete/'.$query->id.'"><i class="bi bi-trash"></i> Delete</a>';

                return $actionButton;

            })->rawColumns(['Edit', 'Delete'])  // for columns which involve html codes
            ->make(true);
    }

    // This function is used to generate the Car Variant DataTable
    public function carvariant(){

        $query = CarVariant::select('*');

        return datatables($query)
            ->addIndexColumn()

            ->addColumn('Car_Brand', function($query){

                $CarBrand = $query->carModel->carBrand->brand;

                return $CarBrand;

            })

            ->addColumn('Car_Model', function($query){

                $CarModel = $query->carModel->model;

                return $CarModel;

            })

            ->addColumn('Edit', function($query){

                $actionButton = '<a href= "/admin/carvariant/edit/'.$query->id.'" style="color: blue; font-size: 16px"><i class="bi bi-pencil-square"></i></a>';

                return $actionButton;

            })

            ->addColumn('Delete', function($query){

                $actionButton = '<a class= "btn btn-danger btn-sm delete" href= "/admin/carvariant/delete/'.$query->id.'"><i class="bi bi-trash"></i> Delete</a>';

                return $actionButton;

            })->rawColumns(['Edit', 'Delete'])  // for columns which involve html codes
            ->make(true);
    }

    // This function is used to generate the Newsletter DataTable
    public function newsletter(){

            $query = Newsletter::select('*');

             return datatables($query)
            ->addIndexColumn()

            ->addColumn('Link', function($query){

                $Link = '<a href = '.$query->link.' style="font-size: 18px" target="_blank"><i class="bi bi-link-45deg"></i></a>';

                return $Link;

            })

            ->addColumn('Image', function($query){

                $Image = '<a href = "/admin/newsletter/view/'.$query->id.'" style="color: black; font-size: 16px" target="_blank"><i class="bi bi-image"></i></a>';

                return $Image;

            })


            ->addColumn('Edit', function($query){

                $actionBtn = '<a href= "/admin/newsletter/edit/'.$query->id.'" style="color: blue; font-size: 16px"><i class="bi bi-pencil-square"></i></a>';

                return $actionBtn;

            })

            ->addColumn('Delete', function($query){

                $actionBtn = '<a class= "btn btn-danger btn-sm delete" href= "/admin/newsletter/delete/'.$query->id.'"><i class="bi bi-trash"></i> Delete</a>';

                return $actionBtn;

            })

            ->rawColumns(['Image','Link','Edit','Delete'])
            ->make(true);

    }

    // This function is used to generate the Used Car DataTable
    public function usedcar(){

        $query = usedcar::select('*');

        return datatables($query)
            ->addIndexColumn()
                ->addColumn('Status', function($query){

                    if ($query->status == 0){

                        $status = "Hidden";

                    } else if ($query->status == 1){

                        $status = "Catalogue";

                    } else {

                        $status = "Wholesale";

                    }

                    return $status;

                })
                ->addColumn('Data_File', function($query){

                    $dataFile = '<a href = "/admin/usedcar/file/viewdata/'.$query->id.'" style="color: blue; font-size: 18px"><i class="bi bi-download"></i></a>';

                    return $dataFile;

                })

                ->addColumn('Ownership_File', function($query){

                    $ownershipFile = '<a href = "/admin/usedcar/file/viewownership/'.$query->id.'" style="color: black; font-size: 16px" target="_blank"><i class="bi bi-eye-fill"></i></a>';

                    return $ownershipFile;

                })

                ->addColumn('Images', function($query){

                    $actionBtn = '<a href = "/admin/usedcar/images/'.$query->id.'" style="color: black; font-size: 16px"><i class="bi bi-image"></i></a>';

                    return $actionBtn;
                })

                ->addColumn('Edit', function($query){

                    $actionBtn = '<a href = "/admin/usedcar/edit/'.$query->id.'" style="color: blue; font-size: 16px"><i class="bi bi-pencil-square"></i></a>';

                    return $actionBtn;
                })

                ->addColumn('Delete', function($query){

                    $actionBtn = '<a class= "btn btn-danger btn-sm delete" href = "/admin/usedcar/delete/'.$query->id.'"><i class="bi bi-trash"></i> Delete</a>';

                    return $actionBtn;

                })->rawColumns(['Data_File', 'Ownership_File', 'Images', 'Edit', 'Delete'])
                ->make(true);

    }

}
