<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function AllSlider(){
        $data['sliderdata'] = Slider::get();
        return view('admin.slider.all_slider',$data);
    } //End Methode 
    public function AddSlider(){
        return view('admin.slider.add_slider');
    } //End Methode

    public function SliderStore(Request $request){
        
        $image = $request->file('slider_img');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('upload/Slider/'.$name_gen);
        $save_url = 'upload/Slider/'.$name_gen;

        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title'  => $request->short_title,
            'slider_img'   => $save_url, 
        ]);
        $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('add.slider')->with($notification); 
    } //end methode

    public function EditSlider($id){
        $data['slider_data'] = Slider::find($id);
        
        return view('admin.slider.Edit_slider',$data);
    } //end methode


    public function SliderUpdate(Request $request){
        
        $slider_id =$request->slider_id;
        $old_image =$request->slider_img;
        if($request->file('slider_img')){
           $image = $request->file('slider_img');

   $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('upload/Slider/'.$name_gen);
        $save_url = 'upload/Slider/'.$name_gen;
   if (file_exists($old_image)) {
       unlink($old_image);
    }

    Slider::findOrFail($slider_id)->update([
        'slider_title' => $request->slider_title,
        'short_title'  => $request->short_title,
        'slider_img'   => $save_url,  
   ]);
   $notification = array(
       'message' => 'Slider Update with Image Successfully',
       'alert-type' => 'success'
   );

   return redirect()->route('all.slider')->with($notification); 
        }else{

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title'  => $request->short_title,
                 
   ]);
   $notification = array(
       'message' => 'Slider Update Successfully',
       'alert-type' => 'success'
   );

   return redirect()->route('all.slider')->with($notification); 

        }
   
  
} //End Methode
public function DeleteSlider($id){
        
    $Slider = Slider::find($id);
    $slider_img = $Slider->slider_img;
    unlink($slider_img);

    $Slider->delete();
    $notification = array(
        'message' => 'Slider Delete Successfully',
        'alert-type' => 'info'
    );

    return redirect()->back()->with($notification); 
    
    
}



}