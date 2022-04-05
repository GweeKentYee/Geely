<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            'link' => ['required', 'url'],
            'sequence' => ['required','unique:newsletters,sequence'],
            'image' => ['required', 'mimes:jpg,bmp,png,tiff']
        ]);

        $ImageName = request()->file('image')->getClientOriginalName();

        $ImagePath = $data['image']->move('storage/image/newsletter',$ImageName);

        Newsletter::create([
            'link' => $data['link'],
            'image' => str_replace('\\','/',$ImagePath),
            'sequence' => $data['sequence'],
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
            'link' => ['nullable','url'],
            'sequence' => ['unique:newsletters,sequence,'.$newsletterID],
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
