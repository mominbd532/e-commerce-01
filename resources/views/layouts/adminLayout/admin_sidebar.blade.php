
<?php $url = url()->current(); ?>

<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li @if(preg_match("/dashboard/i", $url)) class="active" @endif ><a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Category</span> <span class="label label-important">2</span></a>
            <ul @if(preg_match("/category/i", $url)) style="display: block;" @endif >
                <li @if(preg_match("/add-category/i", $url)) class="active" @endif  ><a href="{{url('/admin/add-category')}}">Add Category</a></li>
                <li @if(preg_match("/view-category/i", $url)) class="active" @endif  ><a href="{{url('/admin/view-category')}}">View Category</a></li>

            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Product</span> <span class="label label-important">2</span></a>
            <ul @if(preg_match("/product/i", $url)) style="display: block;" @endif >
                <li  @if(preg_match("/add-product/i", $url)) class="active" @endif ><a href="{{url('/admin/add-product')}}">Add Product</a></li>
                <li  @if(preg_match("/view-product/i", $url)) class="active" @endif ><a href="{{url('/admin/view-product')}}">View Product</a></li>

            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupon</span> <span class="label label-important">2</span></a>
            <ul @if(preg_match("/coupon/i", $url)) style="display: block;" @endif >
                <li @if(preg_match("/add-coupon/i", $url)) class="active" @endif ><a href="{{url('/admin/add-coupon')}}">Add Coupon</a></li>
                <li @if(preg_match("/view-coupons/i", $url)) class="active" @endif ><a href="{{url('/admin/view-coupons')}}">View Coupons</a></li>

            </ul>
        </li>

        <li class="submenu"> <a href="{{url('/admin/add-banner')}}"><i class="icon icon-th-list"></i> <span>Banner</span> <span class="label label-important">2</span></a>
            <ul @if(preg_match("/banner/i", $url)) style="display: block;" @endif >
                <li @if(preg_match("/add-banner/i", $url)) class="active" @endif ><a href="{{url('/admin/add-banner')}}">Add Banner</a></li>
                <li @if(preg_match("/view-banners/i", $url)) class="active" @endif ><a href="{{url('/admin/view-banners')}}">View Banners</a></li>

            </ul>
        </li>

    </ul>
</div>
<!--sidebar-menu-->