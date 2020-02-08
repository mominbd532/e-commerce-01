@extends('layouts.frontLayout.front_design')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('layouts.frontLayout.front_sidebar')
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                    <a href="{{asset('/images/backend_images/products/large/'.$productDetails->image)}}">
                                       <img class="mainImages" src="{{asset('/images/backend_images/products/medium/'.$productDetails->image)}}" alt="" style="border: 1px solid #F7F7F0; height: 380px; width: 100%;" />
                                    </a>
                                </div>
                               <!-- <h3>ZOOM</h3>-->
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active thumbnails">
                                        <a href="{{asset('/images/backend_images/products/large/'.$productDetails->image)}}" data-standard="{{asset('/images/backend_images/products/medium/'.$productDetails->image)}}">
                                            <img class="changeImage" style="width: 80px; cursor: pointer;" src="{{asset('/images/backend_images/products/small/'.$productDetails->image)}}" alt="">
                                        </a>
                                        @foreach($productAltImages as $img)
                                            <a href="{{asset('/images/backend_images/products/large/'.$img->images)}}" data-standard="{{asset('/images/backend_images/products/medium/'.$img->images)}}">
                                                 <img class="changeImage" style="width: 80px; cursor: pointer;" src="{{asset('/images/backend_images/products/small/'.$img->images)}}" alt="">
                                            </a>
                                        @endforeach
                                    </div>


                                </div>


                            </div>

                        </div>
                        <div class="col-sm-7">
                            <form name="addToCartForm" id="addToCartForm" action="{{url('add-cart')}}" method="post" >
                                {{ csrf_field() }}
                                <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                                <input type="hidden" name="product_name" value="{{$productDetails->product_name}}">
                                <input type="hidden" name="product_code" value="{{$productDetails->product_code}}">
                                <input type="hidden" name="product_color" value="{{$productDetails->product_color}}">
                                <input type="hidden" name="price" id="price" value="{{$productDetails->price}}">



                                <div class="product-information"><!--/product-information-->
                                <img src="{{asset('/images/frontend_images/product-details/new.jpg')}}" class="newarrival" alt="" />
                                <h2>{{$productDetails->product_name}}</h2>
                                <p>Code: {{$productDetails->product_code}} </p>
                                <p>
                                    <select id="selectSize" name="size" style="width: 150px;">

                                        <option value="">Select Size</option>
                                        @foreach($productDetails->attributes  as  $attribute)
                                        <option value="{{$productDetails->id}}-{{$attribute->size}}">{{$attribute->size}}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <img  src="{{asset('/images/frontend_images/product-details/rating.png')}}" alt="" />
                                <span>
									<span id="getPrice">৳ {{$productDetails->price}}</span>

									<label>Quantity:</label>
									<input type="text" name="quantity" value="1" />
                                    @if($totalStock>0)
									<button type="submit" class="btn btn-fefault cart" id="cartButton">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
                                    @endif
								</span>
                                <p><b>Availability:</b><span id="availability">@if($totalStock>0)In Stock @else Out of Stock @endif</span> </p>
                                <p><b>Condition:</b> New</p>

                                <a href=""><img  src="{{asset('/images/frontend_images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
                            </div><!--/product-information-->

                            </form>
                        </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                                <li><a href="#care" data-toggle="tab">Material & Care</a></li>
                                <li><a href="#delivery" data-toggle="tab">Delivery Option</a></li>

                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="description" >
                                <div class="col-sm-12">
                                    <p>{{$productDetails->description}} </p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="care" >
                                <div class="col-sm-12">
                                    <p>{{$productDetails->care}}</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="delivery" >
                                <div class="col-sm-12">
                                    <p>
                                        100% Original Products<br>
                                        Free Delivery on order above ৳ 1199<br>
                                        Cash on delivery might be available<br>
                                        Easy 30 days returns and exchanges<br>
                                        Try & Buy might be available
                                    </p>
                                </div>
                            </div>



                        </div>
                    </div><!--/category-tab-->

                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner">
                                <?php $count=1; ?>
                                @foreach( $relatedProduct->chunk(3) as $chunk)
                                <div <?php if($count==1) { ?> class="item active" <?php } else {
                                    ?> class="item" <?php } ?> >
                                    @foreach($chunk as $item)
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img style="width: 230px;" src="{{asset('/images/backend_images/products/small/'.$item->image)}}" alt="" />
                                                    <h2>৳ {{$item->price}}</h2>
                                                    <p>{{$item->product_name}}</p>
                                                    <a href="{{url('/product-details/'.$item->id)}}">
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                    <?php $count++; ?>

                                    @endforeach


                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>

@endsection