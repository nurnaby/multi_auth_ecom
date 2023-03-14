<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function FrontEndView(){
        $data['categoryies'] = Category::OrderBy('category_name','ASC')->get();
        $data['sliders'] = Slider::OrderBy('slider_title','ASC')->get();
        $data['banners'] = Banner::OrderBy('banner_title','ASC')->limit(3)->get();
        $data['products'] = product::where('status',1)->OrderBy('id','ASC')->limit(5)->get();
        $data['products'] = product::where('feature',1)->OrderBy('id','DESC')->limit(5)->get();
        $skipCategory = Category::skip(0)->first();
        $data['CatProduct'] = product::where('status',1)->where('category_id',$skipCategory->id)->orderBy('id','DESC')->limit(5)->get();//category table first product dispaly

        $skipCategory_1 = Category::skip(1)->first();
        $data['CatProduct_1'] = product::where('status',1)->where('category_id',$skipCategory_1->id)->orderBy('id','DESC')->limit(5)->get();//category table 2nd product dispaly
        $data['hotDealProduct'] = product::where('status',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();//hot deal product dispaly
        $data['specialDealProduct'] = product::where('status',1)->where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();//hot deal product dispaly
        $data['specialDealProduct'] = product::where('status',1)->where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();//hot deal product dispaly
        $data['ResentProduct'] = product::where('status',1)->orderBy('id','DESC')->limit(3)->get();//Resent  product dispaly
        $data['SpecialDealProduct'] = product::where('status',1)->where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();//hot deal product dispaly
        $data['allvendor'] = User::where('status',1)->where('role','vendor')->orderBy('id','DESC')->limit(4)->get();//all vendor dispaly

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $data['cart_data'] = json_decode($cookie_data, true);
        
        return view('frontend.index',compact('skipCategory_1','skipCategory'),$data);
    }
}