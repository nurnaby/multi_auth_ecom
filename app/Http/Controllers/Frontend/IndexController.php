<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\product;
use App\Models\Category;
use App\Models\multiImage;
use App\Models\SubCategory;
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
    }//end methode

    public function CatwidseProduct($id,$slug){
        $data['products'] = product::where('status',1)->where('category_id',$id)->orderBy('id','DESC')->get();
        $data['categories'] = Category::where('status',1)->orderBy('category_name','ASC')->get();
        $breadCate = Category::where('status',1)->where('id',$id)->first(); //get category 
        $data['newProduct'] = product::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.cat_product',compact('breadCate'),$data);

    }
    public function SubCatwidseProduct($id,$slug){
        $data['products'] = product::where('status',1)->where('subcategory_id',$id)->orderBy('id','DESC')->get();
        $data['categories'] = Category::where('status',1)->orderBy('category_name','ASC')->get();
        $breadCate = SubCategory::where('status',1)->where('id',$id)->first(); //get category 
        $data['newProduct'] = product::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.Subcat_product',compact('breadCate'),$data);

    }//end methode


    public function ProductViewAjax($id){
        $product = product::with('category','barnd')->find($id);
        $color = $product->product_color;
        $product_color = explode(',',$color);
        $size = $product->product_size;
        $product_size = explode(',',$size);

        return response()->json(array(
            'product' =>$product,
            'color' =>$product_color,
            'size' =>$product_size,
        ));
    }
}