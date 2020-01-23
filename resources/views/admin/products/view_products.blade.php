@extends('layouts.adminLayout.admin_design')

@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">View Products</a> </div>
            <h1>Products</h1>
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
                            <h5>View Product</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Product Id</th>
                                    <th>Category Id</th>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Product Color</th>
                                    <th>Product Image</th>
                                    <th>Product Price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr class="gradeX">
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->category_id}}</td>
                                        <td>{{$product->category_name}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->product_code}}</td>
                                        <td>{{$product->product_color}}</td>
                                        <td>
                                            @if(!empty($product->image))
                                                <img src="{{asset('/images/backend_images/products/small/'.$product->image)}}" width="70px">
                                                @endif

                                        </td>
                                        <td>{{$product->price}}</td>
                                        <td class="center">
                                            <a href="#myModal{{$product->id}}" data-toggle="modal" class="btn btn-success btn-mini">View</a>
                                            <a href="{{url('/admin/edit-product/'.$product->id)}}" class="btn btn-primary btn-mini">Edit</a>
                                            <a rel="{{$product->id}}" rel1="delete-product" <?php /*href="{{url('/admin/delete-product/'.$product->id)}}"*/ ?>
                                            href="javascript:" class="btn btn-danger btn-mini deleteRecord" >Delete</a>
                                        </td>
                                    </tr>
                                    <div id="myModal{{$product->id}}" class="modal hide">
                                        <div class="modal-header">
                                            <button data-dismiss="modal" class="close" type="button">×</button>
                                            <h3>{{$product->category_name}} Full Details</h3>
                                        </div>
                                        <div class="modal-body">
                                            <p>Product Id: {{$product->id}}</p>
                                            <p>Category Id: {{$product->category_id}}</p>
                                            <p>Product Code: {{$product->product_code}}</p>
                                            <p>Product Color: {{$product->product_color}}</p>
                                            <p>Price: {{$product->price}}</p>
                                            <p>Description: {{$product->description}} </p>
                                        </div>
                                    </div>
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