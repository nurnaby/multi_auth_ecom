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
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function AllProduct(){
        $data['allProduct'] = product::latest()->get();
       return view('admin.product.all_product',$data);
    }
    public function AddProduct(){
        
       
        $data['brand'] = brand::where('status','1')->latest()->get();
        $data['category'] = Category::where('status','1')->latest()->get();
        $data['SubCategory'] = SubCategory::where('status','1')->latest()->get();
        $data['vendors'] = User::where('status','active')->where('role','vendor')->latest()->get();
       return view('admin.product.add_product',$data);
    } //end methode

    public function ProductStore(Request $request){
        
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
            'vendor_id'         => $request->vendor_id,
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
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('All.product')->with($notification); 
    } //end methode

    public function EditProduct($id){
        $data['multiImage']  = multiImage ::where('product_id',$id)->get();
        $data['brand']       = brand      ::where('status','1')->latest()->get();
        $data['category']    = Category   ::where('status','1')->latest()->get();
        $data['SubCategory'] = SubCategory::where('status','1')->latest()->get();
        $data['vendors']     = User       ::where('status','active')->where('role','vendor')->latest()->get();
        $data ['product']    = product    ::where('status',1)->latest()->find($id);
        return view('admin.product.Edit_product',$data);
    } //end methode
    public function ProductUpdate(Request $request){
            $product_id =$request->id;
        product::find($product_id)->update([

            'brand_id'       => $request->brand_id,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name'   => $request->product_name,
            'product_slug'   => strtolower(str_replace(' ','-',$request->product_name)),

            'product_code'   => $request->product_code,
            'product_qty'    => $request->product_qty,
            'product_tage'   => $request->product_tage,
            'product_size'   => $request->product_size,
            'product_color'  => $request->product_color,

            'selling_price'  => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp'    => $request->short_descp,
            'long_descp'     => $request->long_descp, 

            'hot_deals'      => $request->hot_deals,
            'feature'        => $request->feature,
            'special_offer'  => $request->special_offer,
            'special_deals'  => $request->special_deals, 

            
            'vendor_id'      => $request->vendor_id,
            'status'         => 1,
            'created_at'     => Carbon::now(), 

        ]);
        $notification = array(
            'message' => 'Product Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('All.product')->with($notification); 




    }//end methode

    
    public function MainImageUpdate(Request $request){
        $validated = $request->validate([
            'product_thumbnail' => 'required',
            
        ]);
        $product_id = $request->id; 
        $old_image  = $request->old_image;

        $image      = $request->file('product_thumbnail');
        $name_gen   = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image       :: make($image)->resize(800,800)->save('upload/products/thambnail/'.$name_gen);
        $save_url   = 'upload/products/thambnail/'.$name_gen;

        if (file_exists($old_image)) {
            unlink($old_image);
         }
         product::find($product_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at'        => Carbon::now()

         ]);
         $notification = array(
            'message'    => 'Main Image Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('product.edit')->with($notification); 


    }//end methode
    
    // Multi image update
    public function MultImageUpdate(Request $request){
        $validated = $request->validate([
            'multi_image' => 'required',
            
        ]);
        
        $imgs =$request->multi_image;
        foreach($imgs as $id => $img ){
            $imgDel = multiImage::find($id);
            unlink($imgDel->photo_name);
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(800,800)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;

            multiImage::where('id',$id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message'    => 'Multi Image Update Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification); 

        }

    }//end methode
    // multi image delete 
    public function DeleteProductMultiImg($id){
        $oldimg = multiImage::find($id);
        unlink($oldimg->photo_name);
        $oldimg->delete();
        $notification = array(
            'message'    => 'Multi Image delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }//end methode
    // product inactive 
    public function ProductInactive($id){
        product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message'    => 'product status Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end methode
    // product active 
    public function ProductActive($id){
        product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message'    => 'product status Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end methode

    public function ProductDelete($id){
                $product = product::find($id);
                unlink($product->product_thumbnail);
               
                $multi_img = multiImage::where('product_id',$id)->get();
                foreach($multi_img as $img){
                        unlink($img->photo_name);
                        multiImage::where('product_id',$id)->delete();
                }
                $product->delete();

                $notification = array(
                    'message'    => 'product delete Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);

    }

}