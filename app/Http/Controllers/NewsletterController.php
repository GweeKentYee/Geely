<?php

// This controller was created for handling Newsletter actions
// No special package used

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class NewsletterController extends Controller
{
    // This function is used to view the ManageNewsletter page
    public function viewAdminPage(){

        return view('ManageNewsletter');

    }

    // This function is used to view the Used Car Image
    public function viewImage($newsletterID){

        $Newsletter = Newsletter::find($newsletterID);

        $image = public_path($Newsletter->image);

        return response()->download($image,'',[],'inline');

    }

    // This function is used to add new newsletter
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

    // This function is used to view the Edit Newsletter page
    public function viewEditPage($newsletterID){

        $Newsletter = Newsletter::find($newsletterID);

        return view('EditNewsletter',[
            'newsletter' => $Newsletter
        ]);

    }

    // This function is used to edit an existing newsletter record
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

            Session::flash('field_empty', 'Please fill in the field.');

            return redirect('admin/newsletter/edit/'.$newsletterID);

        }

    }

    // This function is used to delete an existing newsletter record
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
