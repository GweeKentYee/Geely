<?php

namespace App\Http\Controllers;
use App\Models\Collection;

use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    //
    public function viewPage(Request $Request){


        $checked = $Request->checkedbox;

        $CollectionID = collect($checked);

        $collection = Collection::findMany($CollectionID); 

        return view('Comparison',
        ['collections'=> $collection]);

    }
}