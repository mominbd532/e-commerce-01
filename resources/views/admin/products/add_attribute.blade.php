@extends('layouts.adminLayout.admin_design')

@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Products Attribute</a> </div>
            <h1>Products Attribute</h1>
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
                            <h5>Add Products Attribute</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{url('/admin/add-attribute/'.$product->id)}}" name="add_attribute" id="add_attribute"  enctype="multipart/form-data">
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
                                    <label class="control-label">Product Color</label>
                                    <label class="control-label">
                                        <strong>{{$product->product_color}}</strong>
                                    </label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"></label>
                                    <div class="field_wrapper">
                                        <div>
                                            <input required type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px;"/>
                                            <input required type="text" name="size[]" id="size" placeholder="Size" style="width: 120px;"/>
                                            <input required type="text" name="price[]" id="price" placeholder="Price" style="width: 120px;"/>
                                            <input required type="text" name="stock[]" id="stock" placeholder="Stock" style="width: 120px;"/>
                                            <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="submit" value="Add Attribute" class="btn btn-success">
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
                                    <th>Attributes Id</th>
                                    <th>SKU</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product['attributes'] as $attribute)
                                    <tr class="gradeX">
                                        <td>{{$attribute->id}}</td>
                                        <td>{{$attribute->sku}}</td>
                                        <td>{{$attribute->size}}</td>
                                        <td>{{$attribute->price}}</td>
                                        <td>{{$attribute->stock}}</td>
                                        <td class="center">
                                            <a rel="{{$attribute->id}}" rel1="delete-attribute"
                                            href="javascript:" class="btn btn-danger btn-mini deleteRecord" >Delete</a>
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