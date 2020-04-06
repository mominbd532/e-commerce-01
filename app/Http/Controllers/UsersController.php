<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function register(Request $request){
        if($request->isMethod('post')){
            $data =$request->all();
           $userCount =User::where(['email'=>$data['email']])->count();
           if($userCount>0){
               return redirect()->back()->with('message1','Email already exists');
           }else{
               echo "success"; die;
           }
        }


        return view('users.login_register');
    }

    public function check_email(Request $request)
    {
        $data =$request->all();
        $userCount =User::where(['email'=>$data['email']])->count();
        if($userCount>0){
            echo "false";
        }else{
            echo "true"; die;
        }
    }


}
