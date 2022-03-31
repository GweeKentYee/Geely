<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
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
