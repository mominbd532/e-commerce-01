@extends('layouts.adminLayout.admin_design')

@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Products Images</a> </div>
            <h1>Add Product Images</h1>
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
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Add Products Images</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{url('/admin/add-images/'.$product->id)}}" name="add_images" id="add_images"  enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="control-group">
                                    <label class="control-label">Product Name</label>
                                    <label class="control-label">
                                        <strong>{{$product->product_name}}</strong>
                                    </label>

                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Code</label>
                                    <label class="control-label">
                                        <strong>{{$product->product_code}}</strong>
                                    </label>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Alternating Image(s)</label>
                                    <div class="controls">
                                        <input type="file" name="image[]" id="image" multiple="multiple">
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="submit" value="Add Images" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">

                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>View Attributes</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Image Id</th>
                                    <th>Product Id</th>
                                    <th>Images</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productAltImages as $img)
                                 <tr>
                                     <td>{{$img->id}}</td>
                                     <td>{{$img->product_id}}</td>
                                     <td>
                                         @if(!empty($img->images))
                                             <img src="{{asset('/images/backend_images/products/small/'.$img->images)}}" width="70px">
                                         @endif
                                     </td>
                                     <td>
                                         <a rel="{{$img->id}}" rel1="delete-alt-image" <?php /*href="{{url('/admin/delete-product/'.$product->id)}}"*/ ?>
                                         href="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Image">Delete</a>

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