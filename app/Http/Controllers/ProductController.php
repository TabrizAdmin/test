<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('welcome')->with('products', $products);
    }

    public function getForm(Request $request)
    {
        Product::create($request->all());
    }
}
