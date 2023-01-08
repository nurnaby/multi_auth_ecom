<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function AllSubCategory(){
        $data['subcategorydata'] = SubCategory::get();
        return view('admin.subcategory.all_subcategory',$data);
    }
    
    public function AddSubCateogry(){
        $data['category'] = Category::where('status','1')->get();
        return view('admin.subcategory.add_subcategory',$data);
    } //End Methode
    public function SubCategoryStore(Request $request){
        
        SubCategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'category_id'      => $request->category_id,
            'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)),
            'status'           => $request->status
        ]);
        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('All.SubCategory')->with($notification); 
    } //End method
    public function EditSubCategory(Request $request,$id){
            $data['subcategory']= SubCategory::find($id);
            $data['category'] = Category::where('status','1')->get();


            return view('admin.subcategory.Edit_subcateogry',$data);
    }
    public function SubCategoryStatus(Request $request,$type,$id){
        $data = SubCategory::find($id);
        $data->status = $type;
        
        $data->save();

       $notification = array(
            'message' => 'SubCategory Status update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('All.SubCategory')->with($notification); 



    } //End method
    public function SubCategoryUpdate(Request $request){
        
            $id = $request->id;
            SubCategory::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)), 
                'status'           => $request->status
            ]);
            $notification = array(
                'message' => 'SubCategory update Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('All.SubCategory')->with($notification); 
    }

   
    public function DeleteSubCategory($id){
        
        $SubCategory = SubCategory::find($id);
    
        $SubCategory->delete();
        $notification = array(
            'message' => 'SubCategory Delete Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification); 
        
        
    }
    public function GetSubCategory($id){
        
        $Subcat = SubCategory::where('category_id',$id)->orderBy('subcategory_name','ASC')->get();

        return json_encode($Subcat);
        
        
    }



}