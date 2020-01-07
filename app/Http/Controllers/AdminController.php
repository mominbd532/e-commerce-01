<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();

            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                //echo "Success"; die;
               // Session::put('adminSession',$data['email']);
                return redirect()->to('/admin/dashboard');
            }
            else{
                //echo "Failed"; die;
                return redirect('/admin')->with('message','Invalid Username or Password ');
            }
        }


        return view('admin.admin_login');
    }

    public function dashboard(){
        /*if (Session::has('adminSession')){
            //Perform all dashboard task

        }
        else{
            return redirect('/admin')->with('message','Please login to access');
        }*/
        return view('admin.dashboard');
    }

    public function logout(){
        Session::flush();
        return redirect('/admin')->with('message','Your are successfully logged out');
    }

}
