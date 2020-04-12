<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function loginRegister(){
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

    public function register(Request $request){


        if($request->isMethod('post')){
            $data =$request->all();
            if(!empty($data['email'])){
                $userCount =User::where(['email'=>$data['email']])->count();
                if($userCount>0){
                    return redirect()->back()->with('message1','Email already exists');
                }else{
                    $user = new User();
                    $user->name =$data['name'];
                    $user->email  =$data['email'];
                    $user->password  = bcrypt($data['password']);
                    $user->save();
                    if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                        Session::put('front_login',$data['email']);
                        return redirect()->to('/cart');

                    }
                }
            }else{
                return redirect()->back()->with('message1','Please enter valid email');
            }

        }
    }

    public function logout(){
        Auth::logout();
        Session::forget('front_login');
        return redirect()->to('/');
    }

    public function login(Request $request){
        $data = $request->all();
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            Session::put('front_login',$data['email']);
            return redirect('/cart');
        }else{
            return redirect()->back()->with('message1','You entered invalid email or password');
        }
    }

    public function account(){
        $user_id =Auth::user()->id;
        $user_details =User::find($user_id);
        $countries =Country::get();
        return view('users.account',compact('countries','user_details'));
    }





}
