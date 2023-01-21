<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();
       

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'User Logout successfully',
            'alert-type' => 'success',
        );

        return redirect('/login')->with($notification);
    } //end method
    
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
        $data->phone    = $request->photo;
        $data->photo    = $request->phone;
        $data->address  = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            unlink(public_path('upload/user_images/'.$data->photo));
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
    // public function UserPasswordUpdate(){
        
    // }

    public function UserPasswordUpdate(Request $request){
        $request->validate([
             'old_password'=> 'required',
             'new_password'=> 'required|confirmed',
        ]);
        // match the old password
        if(!Hash::check($request->old_password, auth::user()->password)){
         return back()->with("error", "old password doesn't match");
        }
        User::whereId(auth()->user()->id)->update([
             'password'=> Hash::make($request->new_password)
        ]);
        $notification = array(
         'message' => 'user Change Password successfully',
         'alert-type' => 'success',
     );
        return back()->with($notification);
     }


}