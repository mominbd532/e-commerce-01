<?php

namespace App\Http\Controllers;

use App\Coupon;
use http\Env\Response;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function addCoupon(Request $request){

        if($request->isMethod('post')){
            $data =$request->all();
           // echo "<pre>"; print_r($data); die;
            if(empty($data['status'])){
                $status = 0;
            }else {
                $status = 1;
            }

            $coupon = new Coupon;
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expire_date = $data['expire_date'];
            $coupon->status = $status;
            $coupon->save();

            return redirect()->to('/admin/view-coupons')->with('message','Coupon added successfully');

        }

        return view('admin.coupons.add_coupon');

    }

    public function viewCoupons(){

        $coupons =Coupon::get();
        //echo "<pre>"; print_r($coupons); die;

        return view('admin.coupons.view_coupons')->with(compact('coupons'));
    }

    public function editCoupon(Request $request, $id){

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if(empty($data['status'])){
                $status = 0;
            }else {
                $status = 1;
            }

            $coupon =Coupon::find($id);
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expire_date = $data['expire_date'];
            $coupon->status = $status;
            $coupon->save();

            return redirect()->to('/admin/view-coupons')->with('message','Coupon Updated successfully');


        }

        $couponDetails =Coupon::find($id);
        /*$data =json_decode(json_encode($couponDetails));
        */


        return view('admin.coupons.edit_coupons')->with(compact('couponDetails'));
    }
}
