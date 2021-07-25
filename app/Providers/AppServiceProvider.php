<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Memberbaiki tampilan pagination yang crash karena template front end.
        Paginator::useBootstrap();

        //Membaca variable di spesifik view.
        View::composer(['product.create'], function ($view) {
            $view->with('products', Product::latest()->paginate(6));
        });

        View::composer(['welcome', 'kategori'], function ($view) {
            $view->with('listKategori', (Product::select('kategori')->distinct()->get())->toArray());
        });
    }
}
