<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    public function addProduct(Request $request){

        if($request->isMethod('post')){
            $data =$request->all();
            //echo '<pre>'; print_r($data); die;
            if(empty($data['category_id'])){
                return redirect()->back()->with('message1','Under category ID missing');
            }
            $product = new Product;
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            if(!empty($data['description'])){
                $product->description = $data['description'];
            }
            else{
                $product->description = '';
            }

            $product->price = $data['price'];

            //upload image

            if($request->hasFile('image')){
                $image_tmp =Input::file('image');
                if($image_tmp->isValid()){
                    $extension =$image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,9999).'.'.$extension;
                    $large_file_path ='images/backend_images/products/large/'.$fileName;
                    $medium_file_path ='images/backend_images/products/medium/'.$fileName;
                    $small_file_path ='images/backend_images/products/small/'.$fileName;

                    //Resize Image

                    Image::make($image_tmp)->save($large_file_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_file_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_file_path);

                    //Save fie name
                    $product->image = $fileName;
                }

            }

            $product->save();
            return redirect()->back()->with('message','Product has been added successfully');
        }

        $categories =Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option selected disabled> Select</option>";
        foreach ($categories as $cat){
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories =Category::where(['parent_id'=>$cat->id])->get();
            foreach ($sub_categories as $sub_cat){
                $categories_dropdown .="<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }

        return view('admin.products.add_products',compact('categories_dropdown'));

    }
}
