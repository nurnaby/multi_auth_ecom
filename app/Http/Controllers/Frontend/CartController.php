<?php

namespace App\Http\Controllers\Frontend;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\session;

class CartController extends Controller
{
    public function cartloadbyajax()
    {
        if(Cookie::get('shopping_cart'))
        {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $totalcart = count($cart_data);

            echo json_encode(array('totalcart' => $totalcart)); die;
            return;
        }
        else
        {
            $totalcart = "0";
            echo json_encode(array('totalcart' => $totalcart)); die;
            return;
        }
    }

    public function index(){
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        // return $cart_data;
        return view('Frontend.shoping_cart')
            ->with('cart_data',$cart_data)
        ;
    }
   

    public function AddTocart(Request $request ){
        
        $prod_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $color = $request->input('color');
        $size = $request->input('size');
    if(Cookie::get('shopping_cart'))
    {
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
    }
    else
    {
        $cart_data = array();
    }

    $item_id_list = array_column($cart_data, 'item_id');
    $prod_id_is_there = $prod_id;

    if(in_array($prod_id_is_there, $item_id_list))
    {
        foreach($cart_data as $keys => $values)
        {
            if($cart_data[$keys]["item_id"] == $prod_id)
            {
                $cart_data[$keys]["item_quantity"] = $request->input('quantity');
                $item_data = json_encode($cart_data);
                
                $minutes = 60;
                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));

                return response()->json([

                    'success'=>'"'.$cart_data[$keys]["item_name"].'" Already Added to Cart','status2'=>'2'
                ]);
            }
        }
    }
    else
    {
        $products =  product::find($prod_id);
       $product_name      = $products->product_name;
       $selling_price     = $products->selling_price;
       $discount_price    = $products->discount_price;
       $product_thumbnail = $products->product_thumbnail;

        if($products){
                $item_array = array(
                    'item_id'             => $prod_id,
                    'item_name'           => $product_name,
                    'item_quantity'       => $quantity,
                    'color'               => $color,
                    'size'                => $size,
                    'item_price'          => $selling_price,
                    'item_discount_price' => $discount_price,
                    'item_thum'           => $product_thumbnail
                );
                $cart_data[] = $item_array;
        
                $item_data = json_encode($cart_data);
                $minutes = 60;
                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                $cart_data = json_decode($cookie_data, true);
                        return response()->json([
                            'cart_data'=>$cart_data,
                            'success'=>'"'.$product_name.'" Added to Cart'
                        ]);
               }
    }





    //    $products =  product::find($prod_id);
    //    $product_name      = $products->product_name;
    //    $selling_price     = $products->selling_price;
    //    $discount_price    = $products->discount_price;
    //    $product_thumbnail = $products->product_thumbnail;
    //    if($products){
    //     $item_array = array(
    //         'item_id'             => $prod_id,
    //         'item_name'           => $product_name,
    //         'item_quantity'       => $quantity,
    //         'color'               => $color,
    //         'size'                => $size,
    //         'item_price'          => $selling_price,
    //         'item_discount_price' => $discount_price,
    //         'item_thum'           => $product_thumbnail
    //     );
    //     $cart_data[] = $item_array;

    //     $item_data = json_encode($cart_data);
    //     $minutes = 60;
    //     Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
    //             return response()->json(['status'=>'"'.$product_name.'" Added to Cart']);
    //    }
    

            // $product = product::find($id);

            // if($product->discount_price ==NULL){

            //     // Cart::add([

            //     //     'id' => $id,
            //     //     'name' => $request->product_name,
            //     //     'qty' => $request->quantity,
            //     //     'price' => $product->selling_price,
            //     //     'weight' => 1,
            //     //     'options' => [
            //     //         'image' => $product->product_thumbnail,
            //     //         'color' => $request->color,
            //     //         'size' => $request->size,
            //     //     ],
            //     // ]);

               
            //     return response()->json(['success'=>'Successfully add on cart']);
            // }else{
            //     // Cart::add([

            //     //     'id' => $id,
            //     //     'name' => $request->product_name,
            //     //     'qty' => $request->quantity,
            //     //     'price' => $product->selling_price,
            //     //     'weight' => 1,
            //     //     'options' => [
            //     //         'image' => $product->product_thumbnail,
            //     //         'color' => $request->color,
            //     //         'size' => $request->size,
            //     //     ],
            //     // ]);
            //     return response()->json(['success'=>'Successfully with discount on cart']);
            // }
    } //end add to cart
    // mini cart start 
    public function minicartViewAjax(){
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        return response()->json([
            'cart_data'=>$cart_data,
            
        ]);

    }
    // mini cart end

    public function UpdateCart(Request $request){
        $prod_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        if(Cookie::get('shopping_cart'))
        {
            
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            $item_id_list = array_column($cart_data, 'item_id');
            $prod_id_is_there = $prod_id;

            if(in_array($prod_id_is_there, $item_id_list))
            {
                foreach($cart_data as $keys => $values)
                {
                    if($cart_data[$keys]["item_id"] == $prod_id)
                    {
                        $cart_data[$keys]["item_quantity"] =  $quantity;
                        $subTotal = ($cart_data[$keys]["item_price"]*$quantity);
                        $item_data = json_encode($cart_data);
                        $minutes = 60;
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json([
                            'success'=>'"'.$cart_data[$keys]["item_name"].'" Quantity Updated',
                            'subTotal'=>''.$subTotal.''
                    ]);
                    }
                }
            }
        }
    } //end update cate
    public function DeleteCart(Request $request)
    {
        $prod_id = $request->input('product_id');

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if(in_array($prod_id_is_there, $item_id_list))
        {
            foreach($cart_data as $keys => $values)
            {
                if($cart_data[$keys]["item_id"] == $prod_id)
                {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['success'=>'Item Removed from Cart']);
                }
            }
        }
    }




}
?>