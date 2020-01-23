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

Route::get('/', function () {
    return view('welcome');
});


Route::match(['get','post'],'/admin','AdminController@login');

Route::group(['middleware'=>['auth']],function (){

    Route::get('/admin/dashboard','AdminController@dashboard');
    Route::get('/admin/setting','AdminController@setting');
    Route::get('/admin/check-pwd','AdminController@chkPassword');
    Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
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




});


Route::get('/admin/logout','AdminController@logout');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

