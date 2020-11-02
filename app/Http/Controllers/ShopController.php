<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ShopController extends Controller
{
    public function index()
    {
        $newProducts = Product::inRandomOrder()->with('productImage')->take(18)->get();
        return view('shop.index')->with([
            'newProducts' => $newProducts
        ]);
    }
    public function show($id)
    {
        $product = Product::where('id', $id)->with('productImage')->first();
        $product->image = $product->productImage->first();
        // $mightAlsoLike = Product::where('id', '!=', $product->id)->mightAlsoLike()->get();
        $mightAlsoLike = Product::where('id', '!=', $product->id)->inRandomOrder()->with('productImage')->take(6)->get();

        return view('shop.show')->with([
            'product' => $product,
            'mightAlsoLike' => $mightAlsoLike
        ]);
    }

    public function catalog(Request $request)
    {
        //get random sub categories
        $productCategories = SubCategory::inRandomOrder()->take(20)->get();

        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'title',
                'subCategory',
                AllowedFilter::scope('min_price'),
                AllowedFilter::scope('max_price'),
            ])
            ->with('productImage')
            ->paginate(1);

        return view('shop.catalog')->with([
            'productCategories' => $productCategories,
            'products' => $products
        ]);
    }
}
