<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Illuminate\Http\Request;

class DataTableController extends Controller
{
    //
    public function inspection(){

        $query = Inspection::select('*');

        return datatables($query)
            ->addIndexColumn()
                ->addColumn('Action', function($query){

                    $actionBtn = //'<a href = "/player/download/' .$query->JSON_file. '" class = "download btn btn-primary btn-sm">Download</a>
                                    //'<a class = "btn btn-success btn-sm edit" href = "/allplayer/edit/'.$query->id.'">Edit</a>
                                    '<a class= "btn btn-danger btn-sm delete" href= "/account/game/delete/'.$query->users_id.'/'.$query->id.'" >Delete</a>'
                                    ;
                    return $actionBtn;

                })->rawColumns(['Action'])
                ->make(true);

    }
}
