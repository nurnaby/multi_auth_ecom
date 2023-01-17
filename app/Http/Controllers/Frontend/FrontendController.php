<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Banner;
use App\Models\Slider;
use App\Models\product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function FrontEndView(){
        $data['categoryies'] = Category::OrderBy('category_name','ASC')->get();
        $data['sliders'] = Slider::OrderBy('slider_title','ASC')->get();
        $data['banners'] = Banner::OrderBy('banner_title','ASC')->limit(3)->get();
        $data['products'] = product::where('status',1)->OrderBy('id','ASC')->limit(5)->get();

        

        // $data['SubCategories'] = SubCategory::where('category_id','')->OrderBy('subcategory_name','ASC')->get();
        return view('frontend.index',$data);
    }
}