<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function VendorDashbord(){
        return view('vendor.index');
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
    
}