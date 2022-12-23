<?php

namespace App\Http\Controllers\Backend;

use App\Models\brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function AllBrand(){
        $data['brandata'] = brand::get();
        return view('admin.brand.all_brand',$data);
    }
    public function AddBrand(){
        return view('admin.brand.add_brand');
    } //End Methode
    public function BrandStore(Request $request){
        
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        brand::insert([
            'brand_name'  => $request->brand_name,
            'status'      => $request->status,
            'brand_slug'  => strtolower(str_replace(' ', '-',$request->brand_name)),
            'brand_image' => $save_url, 
        ]);
        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('All.brand')->with($notification); 
    }
    public function BrandStatus(Request $request,$type,$id){
        $data = brand::find($id);
        $data->status = $type;
        
        $data->save();

       $notification = array(
            'message' => 'Brand Status update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('All.brand')->with($notification); 



    } //End method

    public function EditBrand($id){
        $data['brand_data'] = brand::find($id);
        
        return view('admin.brand.Edit_brand',$data);
    }
}