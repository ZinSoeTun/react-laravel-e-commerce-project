<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DesignerController extends Controller
{
    //create designer
    public function createDesignerPage(){
        return view('admin.createDesigner');
    }
      //create designer
      public function createDesigner(Request $request){
        // dd($request->toArray());
        //recall function for validation
        $this->vali($request);
        //recall function for data arrange
        $data = $this->dataArrange($request);
        //image for create create function
        //check for image is exist or not
        if ($request->hasFile('designerImage')) {
            //get originalname from image
            $imgName = uniqid() . $request->file('designerImage')->getClientOriginalName();
            //store in local storage
            $request->file('designerImage')->storeAs('public/designer', $imgName);
            //store in database
            $data['image'] = $imgName;
        }
        //create category
        Designer::create($data);
        //return back if success
        return back()->with(['success' => 'Designer has been created!']);
    }

     //designer list
     public function designerList(){
        $designerData = Designer::paginate(5);
        return view('admin.designerList', compact('designerData'));
    }

       //edit designer page
       public function editDesignerPage($id)
       {
           $designerData = Designer::where('id', $id)->first();
           return view('admin.designerEdit', compact('designerData'));
       }
       //designer update
       public function edit($id, Request $request)
       {
           //recall function for validation
           $this->vali($request);
           //recall function for data arrange
           $data = $this->dataArrange($request);
           //for image update function
           if ($request->hasFile('designerImage')) {
               //if image is already exist in local storage
               $designerImg = Designer::where('id', $id)->value('image');
               //then delete
               if ($designerImg != NULL) {
                   //delete image from storage
                   Storage::delete('public/designer/' . $designerImg);
               }
               //get originalname from image
               $imgName = uniqid() . $request->file('designerImage')->getClientOriginalName();
               //store in local storage
               $request->file('designerImage')->storeAs('public/designer', $imgName);
               //store in database
               $data['image'] = $imgName;
           }
           //designer update in db
           Designer::where('id', $id)->update($data);
           //return back if success
           return back()->with(['success' => 'Your Designer Data Has Been Updated!']);
       }
       //detail designer page
       public function detail($id)
       {
           $designerData =  Designer::where('id', $id)->first();
           return view('admin.designerDetail', compact('designerData'));
       }
       //delete designer page
       public function delete($id)
       {
           $designerImg =  Designer::where('id', $id)->value('image');
           if ($designerImg !== Null) {
               Storage::delete('public/designer/' . $designerImg);
           }
           Designer::where('id', $id)->delete();
           return back()->with(['success' => ' The designer you choiced Has Been Deleted!']);
       }



    ////private function for admin create designers
    //private function for data arrange
    private function dataArrange($request)
    {
        return [
            'name' => $request->designerName,
            'description' => $request->designerDescription,
        ];
    }
    //private function for validation edit
    private function vali($request)
    {
        $rules = [
            'designerName' => 'required| string',
            'designerDescription' => 'required |  string',
            'designerImage' => ' required | image |  mimes:png,jpg,jpeg'
        ];

        Validator::make($request->all(), $rules)->validate();
    }
}
