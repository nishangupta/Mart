<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFactory;

/**
 * GET /
 */
class Shop extends Controller
{
    public function __invoke(Carousel $carousel, FlashSale $flashSale, Product $product): View
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
}
