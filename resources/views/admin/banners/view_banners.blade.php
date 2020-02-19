@extends('layouts.adminLayout.admin_design')

@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Banners</a> <a href="#" class="current">View Banners</a> </div>
            <h1>Banners</h1>
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
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">

                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>View Banners</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Banner Id</th>
                                    <th>Banner Title</th>
                                    <th>Banner Link</th>
                                    <th>Banner Image</th>
                                    <th>Banner Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $banner)
                                    <tr class="gradeX">
                                        <td>{{$banner->id}}</td>
                                        <td>{{$banner->title}}</td>
                                        <td>{{$banner->link}}</td>
                                        <td>
                                            @if(!empty($banner->image))
                                                <img src="{{asset('/images/frontend_images/banner/'.$banner->image)}}" width="300px">
                                            @endif

                                        </td>
                                        <td>
                                            @if($banner->status == 1) Active @else Inactive @endif

                                        </td>
                                        <td class="center">

                                            <a href="{{url('/admin/edit-banner/'.$banner->id)}}" class="btn btn-primary btn-mini" title="Edit Product">Edit</a>
                                            <a rel="{{$banner->id}}" rel1="delete-banner" <?php /*href="{{url('/admin/delete-product/'.$product->id)}}"*/ ?>
                                            href="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Banner">Delete</a>

                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@endsection