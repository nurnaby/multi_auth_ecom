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
    

    
}