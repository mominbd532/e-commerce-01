@extends('layouts.frontLayout.front_design')

@section('content')
    <section id="form" style="margin-top: 20px;"><!--form-->
        <div class="container">
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert alert-success alert-block">

                        <button type="button" class="close" data-dismiss="alert">×</button>

                        <strong>{!! session('message') !!}</strong>

                    </div>

                @endif
                @if(Session::has('message1'))
                    <div class="alert alert-danger alert-block">

                        <button type="button" class="close" data-dismiss="alert">×</button>

                        <strong>{!! session('message1') !!}</strong>

                    </div>

                @endif
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="#">
                            <input type="text" placeholder="Name" />
                            <input type="email" placeholder="Email Address" />
                            <span>
								<input type="checkbox" class="checkbox">
								Keep me signed in
							</span>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->

                        <h2>New User Signup!</h2>
                        <form class="form-horizontal" action="{{url('/register')}}" method="post" name="register_form" id="register_form"  >
                            {{csrf_field()}}

                            <div class="control-group">
                                <div class="controls">
                                    <input type="text" name="name" id="name" placeholder="Name"  required >
                                </div>

                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input type="email" name="email" id="email" placeholder="Email Address" required >

                                </div>

                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input type="password" name="password" id="myPassword" placeholder="Password" required >
                                </div>

                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-default">Signup</button>
                            </div>


                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection