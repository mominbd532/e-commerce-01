<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


//Homepage

Route::get('/','IndexController@index');


Route::match(['get','post'],'/admin','AdminController@login');

Route::group(['middleware'=>['auth']],function (){

    Route::get('/admin/dashboard','AdminController@dashboard');
    Route::get('/admin/setting','AdminController@setting');
    Route::get('/admin/check-pwd','AdminController@chkPassword');
    Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');

    //Category Routes (Admin)
    Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');

    Route::get('/admin/view-category','CategoryController@viewCategory');
    Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
    Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');

    //Product Route (Admin)

    Route::match(['get','post'],'/admin/add-product','ProductController@addProduct');
    Route::get('/admin/view-product','ProductController@viewProduct');
    Route::get('/admin/delete-product-image/{id}','ProductController@deleteProductImage');
    Route::match(['get','post'],'/admin/edit-product/{id}','ProductController@editProduct');
    Route::match(['get','post'],'/admin/delete-product/{id}','ProductController@deleteProduct');


    //Attribute Route

    Route::match(['get','post'],'/admin/add-attribute/{id}','ProductController@addAttribute');
    Route::match(['get','post'],'/admin/edit-attribute/{id}','ProductController@editAttribute');

    Route::get('/admin/delete-attribute/{id}','ProductController@deleteAttribute');


    //Alternative Images
    Route::match(['get','post'],'/admin/add-images/{id}','ProductController@addImages');
    Route::match(['get','post'],'/admin/delete-alt-image/{id}','ProductController@deleteAltProductImage');

    //Coupon

    Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
    Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
    Route::get('/admin/view-coupons','CouponsController@viewCoupons');
    Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');

    //Banner

    Route::match(['get','post'],'/admin/add-banner','BannerController@addBanner');
    Route::get('/admin/view-banners','BannerController@viewBanners');
    Route::match(['get','post'],'/admin/edit-banner/{id}','BannerController@editBanner');
    Route::get('/admin/delete-banner/{id}','BannerController@deleteBanner');










});


Route::get('/admin/logout','AdminController@logout');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Categories/listing

Route::get('/products/{url}','ProductController@products');


//Product Details

Route::get('/product-details/{id}','ProductController@product');

//Product Price
Route::get('/get-product-price','ProductController@getProductPrice');


//Add to Cart

Route::match(['get','post'],'/add-cart','ProductController@addToCart');

//Cart Page

Route::match(['get','post'],'/cart','ProductController@cart');
Route::get('/cart/delete-product/{id}','ProductController@cartDeleteProduct');
Route::get('/cart/update-quantity/{id}/{quantity}','ProductController@updateProductCartQuantity');

//Coupon

Route::post('/cart/apply-coupon','ProductController@applyCoupon');

//Login Register

Route::get('/login-register','UsersController@loginRegister');
Route::get('/logout','UsersController@logout');
Route::post('/register','UsersController@register');
Route::post('/login','UsersController@login');
Route::match(['get','post'],'/check-email','UsersController@check_email');




Route::group(['middleware'=>['front_login']],function (){

    // Account

    Route::match(['get','post'],'/account','UsersController@account');
    Route::post('/check-user-password','UsersController@checkPassword');

});

