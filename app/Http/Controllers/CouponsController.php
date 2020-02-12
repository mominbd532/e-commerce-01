<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function addCoupon(Request $request){

        if($request->isMethod('post')){
            $data =$request->all();
           // echo "<pre>"; print_r($data); die;
            $coupon = new Coupon;
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expire_date = $data['expire_date'];
            $coupon->status = $data['status'];
            $coupon->save();

        }

        return view('admin.coupons.add_coupon');

    }
}
