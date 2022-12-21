<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function UserDashboard(){
        $id= Auth::user()->id;
        $data['userdata'] = User::find($id);
        return view('index',$data);
    }

    public function UserProfielStore(Request $request){
        $id             = Auth::user()->id;
        $data           = User::find($id);
        $data->name     = $request->name;
        $data->username = $request->username;
        $data->email    = $request->email;
        $data->phone    = $request->phone;
        $data->address  = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $file_name = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/user_images'),$file_name);
           $data['photo'] = $file_name;
        }
        $data->save();
        $notification = array(
            'message' => 'User profile updated successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
        
        
    } //end method


}