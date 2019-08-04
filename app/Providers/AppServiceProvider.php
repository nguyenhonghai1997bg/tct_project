<?php

namespace App\Providers;

use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Product;
use App\Notify;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \Schema::defaultStringLength(191);
        Product::deleted(function ($product) {
            $product->sale->delete();
            $product->warehouse->delete();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(ProductRepositoryInterface $productRepository)
    {
        $notifiesAdmin = Notify::whereNull('to_user')->where('status', 0)->orderBy('id', 'DESC')->paginate(Notify::PERPAGE);
        $countNotifiesAdmin = Notify::whereNull('to_user')->where('status', 0)->count();
        $categories2 = \App\Category::with('catalog')->get(['id', 'name', 'catalog_id', 'slug']);
        $catalogs2 = \App\Catalog::with('categories')->get(['id', 'name']);
        $hotProducts = $productRepository->hotProducts();
        View::share('notifiesAdmin', $notifiesAdmin);
        View::share('countNotifiesAdmin', $countNotifiesAdmin);
        View::share('categories2', $categories2);
        View::share('catalogs2', $catalogs2);
        View::share('hotProducts', $hotProducts);
    }
}
