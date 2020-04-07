<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return redirect()->to('/');
    }


}
