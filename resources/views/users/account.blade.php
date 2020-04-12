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
                    <div class="login-form">
                        <h2>Update your account</h2>
                        <form action="" method="post" name="" id="" >
                            {{csrf_field()}}


                            <button type="submit" class="btn btn-default">Update</button>

                        </form>
                    </div>
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">

                        <h2>Update Password</h2>
                        <form class="form-horizontal" action="" method="post" name="" id=""  >
                            {{csrf_field()}}


                            <div class="form-actions">
                                <button type="submit" class="btn btn-default">Update</button>
                            </div>


                        </form>
                    </div><
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection