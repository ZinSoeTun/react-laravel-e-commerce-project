<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    //create room page
    public function createRoomPage()
    {
        return view('admin.createRoom');
    }
    //create room
    public function createRoom(Request $request)
    {
        //recall function for validation
        $this->vali($request);
        //recall function for data arrange
        $data = $this->dataArrange($request);
        //image for create  function
        //check for image is exist or not
        if ($request->hasFile('roomImage')) {
            //get originalname from image
            $imgName = uniqid() . $request->file('roomImage')->getClientOriginalName();
            //store in local storage
            $request->file('roomImage')->storeAs('public/room', $imgName);
            //store in database
            $data['image'] = $imgName;
        }
        //create room
        Room::create($data);
        //return back if success
        return back()->with(['success' => 'Room has been created!']);
    }

    //room list
    public function roomList()
    {
        $roomData = Room::paginate(3);
        return view('admin.roomList', compact('roomData'));
    }
    //edit room page
    public function editRoomPage($id)
    {
        $roomData = Room::where('id', $id)->first();
        return view('admin.roomEdit', compact('roomData'));
    }
    //room update
    public function edit($id, Request $request)
    {
        //recall function for validation
        $this->vali($request);
        //recall function for data arrange
        $data = $this->dataArrange($request);
        //for image update function
        if ($request->hasFile('productImage')) {
            //if image is already exist in local storage
            $dbImage = Room::where('id', $id)->value('image');
            //then delete
            if ($dbImage != NULL) {
                //delete image from storage
                Storage::delete('public/room/' . $dbImage);
            }
            //get originalname from image
            $imgName = uniqid() . $request->file('productImage')->getClientOriginalName();
            //store in local storage
            $request->file('productImage')->storeAs('public/product', $imgName);
            //store in database
            $data['image'] = $imgName;
        }
        //room update in db
        Room::where('id', $id)->update($data);
        //return back if success
        return back()->with(['success' => 'Your Room Has Been Updated!']);
    }
    //detail room page
    public function detail($id)
    {
        $roomData =  Room::where('id', $id)->first();
        return view('admin.roomDetail', compact('roomData'));
    }
    //delete room page
    public function delete($id)
    {
        $roomImg =  Room::where('id', $id)->value('image');
        if ($roomImg !== Null) {
            Storage::delete('public/room/' . $roomImg);
        }
        Room::where('id', $id)->delete();
        return back()->with(['success' => ' The product you choiced Has Been Deleted!']);
    }


    ////private function for admin create rooms
    //private function for data arrange
    private function dataArrange($request)
    {
        return [
            'type_name' => $request->roomName,
            'description' => $request->roomDescription,
        ];
    }
    //private function for validation edit
    private function vali($request)
    {
        $rules = [
            'roomName' => 'required| string',
            'roomDescription' => 'required |  string',
            'roomImage' => ' required | image |  mimes:png,jpg,jpeg'
        ];

        Validator::make($request->all(), $rules)->validate();
    }
}
