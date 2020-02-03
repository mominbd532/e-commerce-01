<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\ProductsImage;
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

            if(!empty($data['care'])){
                $product->care = $data['care'];
            }
            else{
                $product->care = '';
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
            return redirect()->to('/admin/view-product')->with('message','Product has been added successfully');
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

    public function viewProduct(){
        $products = Product::all();
        foreach ($products as $key => $val){
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin.products.view_products',compact('products'));
    }

    public function editProduct(Request $request, $id){

        if($request->isMethod('post')){
            $data =$request->all();
            //echo '<pre>'; print_r($data); die;

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



                }
            }
            else {
                $fileName = $data['current_image'];
            }


            if(empty($data['description'])){
                $data['description'] = "";
            }

            if(empty($data['care'])){
                $data['care'] = "";
            }



            Product::where(['id'=>$id])->update([
                'category_id'=>$data['category_id'],
                'product_name'=>$data['product_name'],
                'product_code'=>$data['product_code'],
                'product_color'=>$data['product_color'],
                'description'=>$data['description'],
                'care'=>$data['care'],
                'price'=>$data['price'],
                'image'=>$fileName,
            ]);

            return redirect()->back()->with('message','Product Updated Successfully');

        }

        $products = Product::where(['id'=> $id])->first();

        $categories =Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option selected disabled> Select</option>";
        foreach ($categories as $cat){
            if($cat->id == $products->category_id){
                $selected = "selected";
            }
            else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
            $sub_categories =Category::where(['parent_id'=>$cat->id])->get();
            foreach ($sub_categories as $sub_cat){
                if($sub_cat->id == $products->category_id){
                    $selected = "selected";
                }
                else{
                    $selected = "";
                }
                $categories_dropdown .="<option value='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }


        return view('admin.products.edit_products',compact('products','categories_dropdown'));


    }

    public function deleteProductImage($id){

        $product =Product::where(['id'=>$id])->first();

        //Image path

        $large_image_path = "images/backend_images/products/large/";
        $medium_image_path = "images/backend_images/products/medium/";
        $small_image_path = "images/backend_images/products/small/";

        if(file_exists($large_image_path.$product->image)){
            unlink($large_image_path.$product->image);
        }

        if(file_exists($medium_image_path.$product->image)){
            unlink($medium_image_path.$product->image);
        }

        if(file_exists($small_image_path.$product->image)){
            unlink($small_image_path.$product->image);
        }


        Product::where(['id'=>$id])->update(['image'=>""]);
        return redirect()->back()->with('message1','Image Deleted Successfully');
    }


    public function deleteAltProductImage($id){

        $product =ProductsImage::where(['id'=>$id])->first();

        //Image path

        $large_image_path = "images/backend_images/products/large/";
        $medium_image_path = "images/backend_images/products/medium/";
        $small_image_path = "images/backend_images/products/small/";

        if(file_exists($large_image_path.$product->images)){
            unlink($large_image_path.$product->images);
        }

        if(file_exists($medium_image_path.$product->images)){
            unlink($medium_image_path.$product->images);
        }

        if(file_exists($small_image_path.$product->images)){
            unlink($small_image_path.$product->images);
        }


        ProductsImage::where(['id'=>$id])->delete();
        return redirect()->back()->with('message1','Product Alt Image Deleted Successfully');
    }

    public  function deleteProduct($id){
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('message1','Product Deleted Successfully');

    }

    public function addAttribute(Request $request,$id){
        $product = Product::with('attributes')->where(['id'=>$id])->first();
        /*$product = json_decode(json_encode($product));*/
       /* echo '<pre>'; print_r($product); die;*/

        if($request->isMethod('post')){
            $data =$request->all();
            //echo '<pre>'; print_r($data); die;

            foreach ($data['sku']as $key=>$val){
                if(!empty($val)){
                    //Prevent Duplicate SKU Check

                    $skuCount =ProductsAttribute::where('sku',$val)->count();

                    if($skuCount>0){
                        return redirect()->back()->with('message1','SKU already exist, please try another SKU');

                    }

                    //Prevent Duplicate Size Check

                    $sizeCount =ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();

                    if($sizeCount>0){
                        return redirect()->back()->with('message1',''.$data['size'][$key].'   Size already exist for this product, please try another Size');

                    }



                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();

                }

            }

            return redirect()->back()->with('message','Product attribute added successfully');
        }
        return view('admin.products.add_attribute',compact('product'));

    }

    public function addImages(Request $request,$id){
        $product = Product::with('attributes')->where(['id'=>$id])->first();
        /*$product = json_decode(json_encode($product));*/
        /* echo '<pre>'; print_r($product); die;*/

        if($request->isMethod('post')){
            $data =$request->all();
            //echo '<pre>'; print_r($data); die;
            if($request->hasFile('image')){
                $files =$request->file('image');
                foreach ($files as $file){

                    $image = new ProductsImage;
                    $extension =$file->getClientOriginalExtension();
                    $fileName = rand(111,9999).'.'.$extension;
                    $large_file_path ='images/backend_images/products/large/'.$fileName;
                    $medium_file_path ='images/backend_images/products/medium/'.$fileName;
                    $small_file_path ='images/backend_images/products/small/'.$fileName;

                    //Resize Image

                    Image::make($file)->save($large_file_path);
                    Image::make($file)->resize(600,600)->save($medium_file_path);
                    Image::make($file)->resize(300,300)->save($small_file_path);
                    $image->images = $fileName;
                    $image->product_id = $id;
                    $image->save();

                }
            }

            return redirect()->back()->with('message','Image added successfully');
        }

        $productAltImages =ProductsImage::where(['product_id'=>$id])->get();
        return view('admin.products.add_images',compact('product','productAltImages'));

    }

    public function deleteAttribute($id){
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('message1','Product attribute deleted successfully');
    }

    public function products($url){
        $countCategory = Category::where(['url'=>$url,'status'=>1])->count();
        if($countCategory==0){
            abort(404);
        }

        $categories =Category::with('categories')->where(['parent_id'=>0])->get();

        $categoriesDetails =Category::where(['url'=>$url])->first();

        if($categoriesDetails->parent_id==0){
            $subCategories =Category::where(['parent_id'=>$categoriesDetails->id])->get();

            foreach ($subCategories as $subCat){
                $cat_ids[] =$subCat->id;
            }

            $products =Product::whereIn('category_id',$cat_ids)->get();
        }
        else{
            //for sub categories
            $products =Product::where(['category_id'=>$categoriesDetails->id])->get();

        }


        return view('products.listing')->with(compact('categories','products','categoriesDetails'));
    }


    public function product($id){

        $categories =Category::with('categories')->where(['parent_id'=>0])->get();

        $productDetails =Product::with('attributes')->where(['id'=>$id])->first();

        return view('products.details')->with(compact('categories','productDetails'));

    }

    public function getProductPrice(Request $request){
        $data =$request->all();
       /* echo "<pre>"; print_r($data);die;*/
        $proArr = explode("-",$data['idSize']);
        /*echo $proArr[0]; echo $proArr[1]; die;*/
        $productAttribute =ProductsAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();

        echo $productAttribute->price;


    }
}
