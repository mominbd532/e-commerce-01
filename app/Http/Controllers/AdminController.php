<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

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

    public function setting(){
        return view('admin.setting');
    }

    public function chkPassword(Request $request){
        $data = $request->all();
        $current_pwd = $data['current_pwd'];
        $check_password = User::where(['admin'=>'1'])->first();
        if(Hash::check($current_pwd,$check_password->password)){
            echo "true"; die;
        }
        else{
            echo  "false"; die;
        }

    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/

            $check_password =User::where(['email'=> Auth::user()->email])->first();
            $current_password = $data['current_pwd'];
            if(Hash::check($current_password,$check_password->password)){
                $password = bcrypt($data['new_pwd']);
                User::where('id','1')->update(['password' => $password]);
                return redirect('/admin/setting')->with('message','Password Updated Successfully');

            }
            else{
                return redirect('/admin/setting')->with('message1','Incorrect Current Password');


            }


        }
    }

}
