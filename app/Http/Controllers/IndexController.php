<?php

namespace App\Http\Controllers;

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

        $products =Product::inRandomOrder()->get();

        return view('index')->with(compact('products'));
    }
}
