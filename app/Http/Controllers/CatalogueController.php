<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    //
    //
    public function viewPage(){

        return view('Catalogue');

    }

    public function viewAdminPage(){

        return view('ManageCatalogue');

    }

}
