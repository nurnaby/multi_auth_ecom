<?php

namespace App\Http\Controllers\Backend;

use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function AllBanner(){
        $data['bannerdata'] = Banner::get();
        return view('admin.banner.all_banner',$data);
    } //End Methode 
    public function AddBanner(){
        return view('admin.banner.add_banner');
    } //End Methode
    public function BannerStore(Request $request){
        
        $image = $request->file('banner_img');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
        $save_url = 'upload/banner/'.$name_gen;

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_url'   => $request->banner_url,
            'banner_img'   => $save_url, 
        ]);
        $notification = array(
            'message' => 'banner Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification); 
    } //end methode
    public function EditBanner($id){
        $data['banner_data'] = Banner::find($id);
        
        return view('admin.banner.Edit_banner',$data);
    } //end methode

    public function BannerUpdate(Request $request){
        
        $banner_id =$request->banner_id;
        $old_image =$request->banner_img;
        if($request->file('banner_img')){
           $image = $request->file('banner_img');

           $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
           $save_url = 'upload/banner/'.$name_gen;
   if (file_exists($old_image)) {
       unlink($old_image);
    }

    Banner::findOrFail($banner_id)->update([
            'banner_title' => $request->banner_title,
            'banner_url'   => $request->banner_url,
            'banner_img'   => $save_url,  
   ]);
   $notification = array(
       'message' => 'Banner Update with Image Successfully',
       'alert-type' => 'success'
   );

   return redirect()->route('all.banner')->with($notification); 
        }else{

            Banner::findOrFail($banner_id)->update([
                'banner_title' => $request->banner_title,
                'banner_url'   => $request->banner_url,
            
                 
   ]);
   $notification = array(
       'message' => 'Banner Update Successfully',
       'alert-type' => 'success'
   );

   return redirect()->route('all.banner')->with($notification); 

        }
   
  
} //End Methode
public function DeleteBanner($id){
        
    $banner = Banner::find($id);
    $banner_img = $banner->banner_img;
    unlink($banner_img);

    $banner->delete();
    $notification = array(
        'message' => 'Banner Delete Successfully',
        'alert-type' => 'info'
    );

    return redirect()->back()->with($notification); 
    
    
}



}