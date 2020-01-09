<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        if($request->isMethod('post')){
            $data =$request->all();
            //echo '<pre>'; print_r($data); die;
            $category = new Category;
            $category->name = $data['category_name'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->save();

            return redirect()->to('/admin/view-category')->with('message','Category added successfully');
        }
        return view('admin.categories.add_categories');
    }

    public function viewCategory(){
        $categories =Category::get();
        return view('admin.categories.view_categories',compact('categories'));
    }

    public function editCategory(Request $request, $id ){
        if($request->isMethod('post')){
            $data =$request->all();
            //echo '<pre>'; print_r($data); die;
            Category::where(['id'=>$id])->update([
                'name'=>$data['category_name'],
                'description'=>$data['description'],
                'url'=>$data['url'],
            ]);

            return redirect()->to('/admin/view-category')->with('message','Category updated successfully');

        }

        $category_details =Category::where(['id'=> $id])->first();

        return view('admin.categories.edit_categories',compact('category_details'));
    }

    public function deleteCategory($id){
        if(!empty($id)){
            Category::where(['id'=> $id])->delete();
            return redirect()->back()->with('message','Category deleted successfully');
        }
    }


}
