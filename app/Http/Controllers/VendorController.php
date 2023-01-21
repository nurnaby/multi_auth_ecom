<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function VendorDashbord(){
        return view('vendor.index');
    } //end method

    public function VendorRegister(){
        // return "vendor page";
        return view('auth.vendor_register');
    } //end method
    
    public function VendorStore(Request $request){
        
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' =>['required','string'],
            'password' =>['required','confirmed'],
        ]);
        User::insert([
            'name' =>$request->name,
            'username' =>$request->username,
            'email' =>$request->email,
            'phone' =>$request->phone,
            'address' =>$request->address,
            'vendor_join' =>$request->vendor_join,
            'password' =>Hash::make($request->password),
            'role'=>'vendor',
            'status'=>'inactive',
        ]);
        $notification = array(
                'message' => 'Vendor Registered Successfully',
                'alert-type' => 'success'
            );
        return redirect()->route('vendor.login')->with($notification);

       
        
    } //end method

    public function VendorLogin(){
        return view('vendor.login');
    } //end method

    public function VendorDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    } //end method

    public function VendorProfile(){
        $id= Auth::user()->id;
        $data['vendor_profile_info'] = User::find($id);
        return view('vendor.profile_view',$data);
    } //end method
    
    public function VendorProfileStore(Request $request){
        $id= Auth::user()->id;
        $data= User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        // $data->photo = $request->photo;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor_images/'.$data->photo));
            $file_name = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/vendor_images'),$file_name);
           $data['photo'] = $file_name;
        }
        $data->save();
        $notification = array(
            'message' => 'Vendor profile updated successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
        
        
    }//end methode

    public function VendorChangePassword(){
        return view('vendor.vendor_chang_password');
    }//end method

    public function VendorPasswordUpdate(Request $request){
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
         'message' => 'Vendor Change Password successfully',
         'alert-type' => 'success',
     );
        return back()->with($notification);
     } //End Method

    


    
}