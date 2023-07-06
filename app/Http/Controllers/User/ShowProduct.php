<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFactory;

/**
 * GET /shop/{id}-{slug}
 */
class ShowProduct extends Controller
{
    public function __invoke($id): View
    {
        /** @var Product $product */
        $product = (new Product())->newQuery()
            ->where('id', $id)
            ->with('productImage')
            ->first();

        $mightAlsoLike = Product::where('id', '!=', $product->id)
            ->inRandomOrder()
            ->with('productImage')
            ->take(6)
            ->get();

        return ViewFactory::make('shop.show')->with([
            'product' => $product,
            'mightAlsoLike' => $mightAlsoLike
        ]);
    }
}
