<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function FrontEndView(){
        $data['categoryies'] = Category::OrderBy('category_name','ASC')->limit(6)->get();
        $data['sliders'] = Slider::OrderBy('slider_title','ASC')->get();
        

        // $data['SubCategories'] = SubCategory::where('category_id','')->OrderBy('subcategory_name','ASC')->get();
        return view('frontend.index',$data);
    }
}