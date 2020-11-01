<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index');
    }
    public function show($id)
    {
        $product = Product::where('id', $id)->with('productImage')->first();
        $product->image = $product->productImage->first();
        // $mightAlsoLike = Product::where('id', '!=', $product->id)->mightAlsoLike()->get();
        $mightAlsoLike = Product::where('id', '!=', $product->id)->with('productImage')->get();

        return view('shop.show')->with([
            'product' => $product,
            'mightAlsoLike' => $mightAlsoLike
        ]);
    }
}
