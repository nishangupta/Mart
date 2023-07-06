<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFactory;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * GET /catalog
 */
class Catalog
{
    public function __invoke(): View
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
