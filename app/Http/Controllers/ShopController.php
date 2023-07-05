<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\FlashSale;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFactory;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ShopController extends Controller
{
    public function index(Carousel $carousel, FlashSale $flashSale, Product $product): View
    {
        $carousels = $carousel->newQuery()
            ->latest()
            ->take(3)
            ->get();

        $flashSaleProducts = $flashSale->newQuery()
            ->inRandomOrder()
            ->with('product.productImage')
            ->take(6)
            ->get();

        $randomProducts = $product->newQuery()
            ->inRandomOrder()
            ->with('productImage')
            ->take(24)
            ->get();


        return ViewFactory::make('shop.index')->with([
            'carousels' => $carousels,
            'newProducts' => $randomProducts,
            'flashSaleProducts' => $flashSaleProducts
        ]);
    }
    public function show($id): View
    {
        $product = Product::where('id', $id)
            ->with('productImage')
            ->first();

        $product->image = $product->productImage->first();

        $questions = $product
            ->getQuestions()
            ->with('user')
            ->paginate(6);

        $mightAlsoLike = Product::where('id', '!=', $product->id)
            ->inRandomOrder()
            ->with('productImage')
            ->take(6)
            ->get();

        return ViewFactory::make('shop.show')->with([
            'product' => $product,
            'questions' => $questions,
            'mightAlsoLike' => $mightAlsoLike
        ]);
    }

    public function catalog(): View
    {
        //get random sub categories
        $productCategories = (new SubCategory())
            ->newQuery()
            ->inRandomOrder()
            ->take(20)
            ->get();

        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'title',
                'subCategory',
                AllowedFilter::scope('min_price'),
                AllowedFilter::scope('max_price'),
            ])
            ->with('productImage')
            ->paginate(20);

        return ViewFactory::make('shop.catalog')->with([
            'productCategories' => $productCategories,
            'products' => $products
        ]);
    }
}
