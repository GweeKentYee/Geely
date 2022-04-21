<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Hamcrest\Collection\IsEmptyTraversable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;

class NewsletterController extends Controller
{
    //
    public function viewAdminPage(){

        return view('ManageNewsletter');

    }

    public function viewImage($newsletterID){

        $Newsletter = Newsletter::find($newsletterID);

        $image = public_path($Newsletter->image);

        return response()->download($image,'',[],'inline');

    }

    public function add(Request $request){

        $data = $request->validate([
            'remarks' => ['required'],
            'link' => ['required', 'url'],
            'image' => ['required', 'mimes:jpg,bmp,png,tiff'],
            'status' => ['required']
        ]);

        $current_timestamp = Carbon::now()->timestamp;

        $OriginalImageName = request()->file('image')->getClientOriginalName();

        $ImageName = $current_timestamp.'_'.$OriginalImageName;

        $ImagePath = $data['image']->move('storage/image/newsletter',$ImageName);

        Newsletter::create([
            'remarks' => $data['remarks'],
            'link' => $data['link'],
            'image' => str_replace('\\','/',$ImagePath),
            'status' => $data['status']
        ]);

        return redirect('admin/newsletter');

    }

    public function viewEditPage($newsletterID){

        $Newsletter = Newsletter::find($newsletterID);

        return view('EditNewsletter',[
            'newsletter' => $Newsletter
        ]);

    }

    public function edit($newsletterID, Request $request){

        $Newsletter = Newsletter::find($newsletterID);

        $data = $request->validate([
            'remarks' => ['nullable'],
            'link' => ['nullable','url'],
            'status' => ['nullable'],
        ]);

        $input = collect($data)->whereNotNull()->all();

        if(!empty($input)) {

            $Newsletter->update($input);

            return redirect('admin/newsletter');

        } else {

            return redirect('admin/newsletter');

        }

    }

    public function delete($newsletterID){

        $Newsletter = Newsletter::find($newsletterID);

        $imagepath = str_replace('\\','/',public_path($Newsletter->image));

        if(file_exists($imagepath)){

            unlink($imagepath);

        }

        Newsletter::where('id',$newsletterID)->delete();

        return redirect('admin/newsletter');

    }

}
