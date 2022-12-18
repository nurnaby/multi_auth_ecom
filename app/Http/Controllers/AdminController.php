<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $file_name = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/admin_images'),$file_name);
           $data['photo'] = $file_name;
        }
        $data->save();
        return redirect()->back();
        
        
    } //end method
    

    
}