<?php

namespace App\Providers;

use App\Models\Tag;
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

        View::composer(['welcome', 'display', 'wishlist', 'costs'], function ($view) {
            $view->with('listKategori', (Product::select('kategori')->distinct()->get())->toArray());
            $view->with('listTag', (Tag::select('name')->get())->toArray());
        });

        View::composer(['cart'], function ($view) {
            $view->with('dataOngkir', request()->session()->get('ongkir'));
        });
    }
}
