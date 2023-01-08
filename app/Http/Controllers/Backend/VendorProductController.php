<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\brand;
use App\Models\product;
use App\Models\Category;
use App\Models\multiImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class VendorProductController extends Controller
{
    public function VendorAllProduct(){
        $id =Auth::user()->id;
        $data['allProduct'] = product::where('vendor_id',$id)->latest()->get();
        return view('admin.product.vendor_all_product',$data);
    }

    public function VendorAddProduct(){
        
       
        $data['brand'] = brand::where('status','1')->latest()->get();
        $data['category'] = Category::where('status','1')->latest()->get();
        $data['SubCategory'] = SubCategory::where('status','1')->latest()->get();
        $data['vendors'] = User::where('status','active')->where('role','vendor')->latest()->get();
       return view('admin.product.vendor_add_product',$data);
    } //end method


    public function GetVendorSubCategory($id){
      
        $Subcat = SubCategory::where('category_id',$id)->orderBy('subcategory_name','ASC')->get();

        return json_encode($Subcat);
        
        
    }

    public function vendor_product_store(Request $request){
        
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('upload/products/thambnail/'.$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;

        
        $product_id = product::insertGetId([

            'brand_id'          => $request->brand_id,
            'category_id'       => $request->category_id,
            'subcategory_id'    => $request->subcategory_id,
            'product_name'      => $request->product_name,
            'product_slug'      => strtolower(str_replace(' ','-',$request->product_name)),

            'product_code'      => $request->product_code,
            'product_qty'       => $request->product_qty,
            'product_tage'      => $request->product_tage,
            'product_size'      => $request->product_size,
            'product_color'     => $request->product_color,

            'selling_price'     => $request->selling_price,
            'discount_price'    => $request->discount_price,
            'short_descp'       => $request->short_descp,
            'long_descp'        => $request->long_descp, 

            'hot_deals'         => $request->hot_deals,
            'feature'           => $request->feature,
            'special_offer'     => $request->special_offer,
            'special_deals'     => $request->special_deals, 

            'product_thumbnail' => $save_url,
            'vendor_id'         => Auth::user()->id,
            'status'            => 1,
            'created_at'        => Carbon::now(), 

        ]);
        $images = $request->file('multi_image');
        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(800,800)->save('upload/products/multi-image/'.$make_name);
        $uploadPath = 'upload/products/multi-image/'.$make_name;

        multiImage::insert([

            'product_id' => $product_id,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(), 

        ]); 
        } // end foreach

        /// End Multiple Image Upload From her //////

        $notification = array(
            'message' => ' Vendor Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification); 
    } //end methode
}