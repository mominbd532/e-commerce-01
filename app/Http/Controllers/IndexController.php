<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        //Product by ascending
        $products =Product::get();

        //Product by Descending

        $products =Product::orderBy('id','DESC')->get();

        //Product by Random

        $products =Product::inRandomOrder()->where('status',1)->get();

        //Categories

        $categories =Category::with('categories')->where(['parent_id'=>0])->get();
        /*$categories1 =json_decode(json_encode($categories));
        echo "<pre>"; print_r($categories1); die;*/

        /*$categories_manu = "";

        foreach ($categories as $cat){

            $categories_manu .="<div class='panel-heading'>
                                    <h4 class='panel-title'>
                                        <a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
                                            <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                                            ".$cat->name."
                                        </a>
                                    </h4>
                                </div>
                                <div id='".$cat->id."' class='panel-collapse collapse'>
                                    <div class='panel-body'>
                                        <ul>";
                                        $sub_categories =Category::where(['parent_id'=>$cat->id])->get();
                                         foreach ($sub_categories as $sub_cat){

                                          $categories_manu .= "<li><a href='".$sub_cat->url."'>".$sub_cat->name."</a></li>";
                                          
                                                   }


            $categories_manu .= "</ul>
                                    </div>
                                </div>";

        }*/

        $banners =Banner::where(['status'=> 1])->get();


        return view('index')->with(compact('products','categories','banners'));
    }
}
