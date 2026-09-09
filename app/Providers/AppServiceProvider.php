<?php

namespace App\Providers;

use App\Models\Category;
use App\Services\Cart;
use App\Services\Wishlist;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Cart::class);
        $this->app->singleton(Wishlist::class);
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            $view->with('navCategories', Category::orderBy('position')->withCount('products')->get());
            $view->with('cart', app(Cart::class));
            $view->with('wishlist', app(Wishlist::class));
        });
    }
}
