<?php

namespace App\Http\Controllers\Frontend;

use App\Models\product;
use App\Models\Category;
use App\Models\multiImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function ProductDetails($id,$slug){
        $data['products']      = product::find($id);
        $color                 = $data['products']->product_color;
        $data['product_color'] = explode(',',$color);

        $size                = $data['products']->product_size;
        $data['product_size'] = explode(',',$size);
        $data['multiImages'] = multiImage::where('product_id',$id)->get();
        $cat_id                 = $data['products']->category_id;
        $data['retatedProducts'] = product::where('category_id',$cat_id)->orderBy('id','DESC')->limit(4)->get();

        

        return view('frontend.product.product_details',$data);
    }
}