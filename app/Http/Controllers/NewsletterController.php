<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Hamcrest\Collection\IsEmptyTraversable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            'link' => ['required', 'url'],
            'sequence' => ['required'],
            'image' => ['required', 'mimes:jpg,bmp,png,tiff']
        ]);

        $ImageName = request()->file('image')->getClientOriginalName();

        $ImagePath = $data['image']->move('storage/image/newsletter',$ImageName);

        $exist = Newsletter::where('sequence',$data['sequence'])->get();

        if($exist->count() == 0 || $data['sequence'] == 0){
            
            Newsletter::create([
                'link' => $data['link'],
                'image' => str_replace('\\','/',$ImagePath),
                'sequence' => $data['sequence'],
            ]);
        }else{
            Newsletter::where('sequence','>=',$data['sequence'])->increment('sequence',1);
            Newsletter::where('sequence','>',5)->update(['sequence'=>0]);
            
            Newsletter::create([
                'link' => $data['link'],
                'image' => str_replace('\\','/',$ImagePath),
                'sequence' => $data['sequence'],
            ]);
        }

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
            'sequence' => ['nullable'],
        ]);

        $input = collect($data)->whereNotNull()->all();

        $exist = Newsletter::where('sequence',$data['sequence'])->get();
        if(!empty($input)) {
            if($exist->count() == 0 || $data['sequence'] == 0){
                $Newsletter->update($input);
            }else{
                Newsletter::where('sequence','>=',$data['sequence'])->increment('sequence',1);
                Newsletter::where('sequence','>',5)->update(['sequence'=>0]);
                $Newsletter->update($input);
            }

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

        if($newsletterID==0){
            Newsletter::where('id',$newsletterID)->delete();
        }else{
            $sequence = Newsletter::find($newsletterID);
            Newsletter::where('sequence','>',$sequence->sequence)->decrement('sequence',1);
            Newsletter::where('id',$newsletterID)->delete();
            
        }
        

        return redirect('admin/newsletter');

    }

}
