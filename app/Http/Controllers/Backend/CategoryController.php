<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    
    public function AllCategory(){
        $data['categorydata'] = Category::latest()->get();
        return view('admin.category.all_category',$data);
    }
    
    public function AddCateogry(){
        return view('admin.category.add_category');
    } //End Methode

    public function CategoryStore(Request $request){
        
        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/Category/'.$name_gen);
        $save_url = 'upload/Category/'.$name_gen;

        Category::insert([
            'category_name'  => $request->category_name,
            'status'         => $request->status,
            'category_slug'  => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url, 
        ]);
        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('All.category')->with($notification); 
    } //end methode
    public function CategoryStatus(Request $request,$type,$id){
        $data = Category::find($id);
        $data->status = $type;
        
        $data->save();

       $notification = array(
            'message' => 'Category Status update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('All.category')->with($notification); 



    } //End method

    public function EditCategory($id){
        $data['Category_data'] = Category::find($id);
        
        return view('admin.Category.Edit_cateogry',$data);
    }
    public function CategoryUpdate(Request $request){
        
             $category_id =$request->id;
             $old_image =$request->brand_image;
             if($request->file('category_image')){
                $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/Category/'.$name_gen);
        $save_url = 'upload/Category/'.$name_gen;
        if (file_exists($old_image)) {
            unlink($old_image);
         }

        Category::findOrFail($category_id)->update([
            'category_name'  => $request->category_name,
            'status'         => $request->status,
            'category_slug'  => strtolower(str_replace(' ', '-',$request->brand_name)),
            'category_image' => $save_url, 
        ]);
        $notification = array(
            'message' => 'Category Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('All.category')->with($notification); 
             }else{

        Category::findOrFail($category_id)->update([
            'category_name'  => $request->category_name,
            'status'         => $request->status,
            'category_slug'  => strtolower(str_replace(' ', '-',$request->category_name)), 
        ]);
        $notification = array(
            'message' => 'Category Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('All.category')->with($notification); 

             }
        
       
    } //End Methode
    public function DeleteCategory($id){
        
        $Category = Category::find($id);
        $category_img = $Category->category_image;
        unlink($category_img);

        $Category->delete();
        $notification = array(
            'message' => 'Category Delete Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification); 
        
        
    }

}