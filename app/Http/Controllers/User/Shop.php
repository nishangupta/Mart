<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFactory;

/**
 * GET /
 */
class Shop extends Controller
{
    public function __invoke(Product $product): View
    {
        $randomProducts = $product->newQuery()
            ->inRandomOrder()
            ->with('productImage')
            ->take(24)
            ->get();

        return ViewFactory::make('shop.index')->with([
            'newProducts' => $randomProducts,
        ]);
    }
}
