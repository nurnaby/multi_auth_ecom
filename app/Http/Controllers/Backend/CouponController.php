<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function AllCoupon(){
        $data['coupons'] = coupon::get();
        return view('admin.coupon.all_coupon',$data);
    } //End Methode 

    public function AddCoupon(){
        
        return view('admin.coupon.add_coupon');
    } //End Methode 

    public function StoreCoupon(Request $request){
        
        Coupon::insert([
            'coupon_name'     => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at'      => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Coupon add  Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification); 
    } //End method

    public function EditCoupon($id){
        $data['coupons'] = coupon::find($id);
        return view('admin.coupon.edit_coupon',$data);
    } //End Methode 

    public function CouponUpdate(Request $request){
        $coupon_id = $request->id;
        coupon::find($coupon_id)->update([
            'coupon_name'     => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at'      => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Coupon add  Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.coupon')->with($notification); 
    }//End method

    public function DeleteCoupon($id){
        $coupon = coupon::find($id);
        $coupon->delete();
        $notification = array(
            'message' => 'Coupon Delete Successfully',
            'alert-type' => 'error'
        );
    
        return redirect()->back()->with($notification); 
    
    }

}