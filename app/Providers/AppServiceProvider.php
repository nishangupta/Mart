<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Paginator::useBootstrap();
        View::composer('layouts.app', function ($view) {
            $navbarCategories = Category::with('subCategory')->take(7)->get();
            $view->with([
                'navbarCategories' => $navbarCategories
            ]);
        });
        // View::composer('shop.index', function ($view) {
        //     $productCategories = Category::inRandomOrder()->take(6)->get();
        //     $view->with([
        //         'productCategories' => $productCategories
        //     ]);
        // });
    }
}
