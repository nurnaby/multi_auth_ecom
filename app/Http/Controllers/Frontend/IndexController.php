<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\product;
use App\Models\Category;
use App\Models\multiImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function ProductDetails($id,$slug){
        $data['products']      = product::find($id);
        $color                 = $data['products']->product_color;
        $data['product_color'] = explode(',',$color);

        $size                = $data['products']->product_size;
        $data['product_size'] = explode(',',$size);
        $data['multiImages'] = multiImage::where('product_id',$id)->get();
        $cat_id                 = $data['products']->category_id;
        $data['retatedProducts'] = product::where('category_id',$cat_id)->orderBy('id','DESC')->limit(4)->get();

        

        return view('frontend.product.product_details',$data);
    }
    // Vendor Details
    public function VendorDetails($id){
        $vendor = User::find($id);
        $data['vendorProduct'] = product::where('vendor_id',$vendor->id)->get();
        return view('frontend.vendor.vendor_datails',compact('vendor'),$data);
    } //end methord
    // vendor List
    public function VendorList(){
        $data['vendor'] = User::where('status','active')->where('role','vendor')->get();
        return view('frontend.vendor.vendor_all',$data);
    }
}