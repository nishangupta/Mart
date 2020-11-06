<?php

namespace App\Http\Controllers;

use App\Models\FlashSale;
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
        $flashSaleProducts = FlashSale::inRandomOrder()->with('product.productImage')->take(12)->get();
        return view('shop.index')->with([
            'newProducts' => $newProducts,
            'flashSaleProducts' => $flashSaleProducts
        ]);
    }
    public function show($id)
    {
        $product = Product::where('id', $id)->with('productImage')->first();
        $product->image = $product->productImage->first();

        $questions = $product->getQuestions()->with('user')->paginate(6);
        $mightAlsoLike = Product::where('id', '!=', $product->id)->inRandomOrder()->with('productImage')->take(6)->get();

        return view('shop.show')->with([
            'product' => $product,
            'questions' => $questions,
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
            ->paginate(20);

        return view('shop.catalog')->with([
            'productCategories' => $productCategories,
            'products' => $products
        ]);
    }
}
