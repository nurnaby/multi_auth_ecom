<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function VendorDashbord(){
        return view('vendor.vendor_dashbord');
    } //end method
    
}