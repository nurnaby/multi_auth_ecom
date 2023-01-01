<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    } //end method
    
    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    } //end method
    public function AdminLogin(){
        return view('admin.login');
    } //end method
    
    public function Admin_profile(){
        $id= Auth::user()->id;
        $data['admin_profile_info'] = User::find($id);
        return view('admin.profile_view',$data);
    } //end method
    
    public function Admin_profile_store(Request $request){
        $id= Auth::user()->id;
        $data= User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $file_name = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/admin_images'),$file_name);
           $data['photo'] = $file_name;
        }
        $data->save();
        $notification = array(
            'message' => 'Admin profile updated successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
        
        
    } //end method
    
    //admin profile end

    public function AdminChangePassword(){
        return view('admin.admin_chang_password');
    }//end method
    
    public function AdminPasswordUpdate(Request $request){
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
        'message' => 'Admin Change Password successfully',
        'alert-type' => 'success',
    );
       return back()->with($notification);
    } //end method

    public function InactiveVendor(){
        $data['inactiveVendor'] = User::where('status','inactive')->where('role','vendor')->latest()->get();
      
        return view('admin.vendor.inactive_vendor',$data);
     }
    public function ActiveVendor(){
        $data['activeVendor'] = User::where('status','active')->where('role','vendor')->latest()->get();
      
        return view('admin.vendor.active_vendor',$data);
     } //End Method
    public function InactiveVendorDetail($id){
                $data['inactiveVendor'] = User::findOrFail($id);
        return view('admin.vendor.inactive_vendor_detail',$data);
     } //End Method

    public function ActiveVendorDetail($id){
                $data['activeVendor'] = User::findOrFail($id);
        return view('admin.vendor.active_vendor_detail',$data);
     } //End Method

     public function InactiveVendorApprove(Request $request){
                $id = $request->id;
                User::findOrFail($id)->update([
                    'status' => 'active'
                ]);
                $notification = array(
                    'message' => 'Vendor Status Active successfully',
                    'alert-type' => 'success',
                );
                return redirect()->route('Active.vendor')->with($notification);

     } //End method

     public function ActiveVendorApprove(Request $request){
                $id = $request->id;
                User::findOrFail($id)->update([
                    'status' => 'inactive'
                ]);
                $notification = array(
                    'message' => 'Vendor Status Inactive successfully',
                    'alert-type' => 'success',
                );
                return redirect()->route('inactive.vendor')->with($notification);

     }
    

    
}