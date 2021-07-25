<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        //kategori 1 (thumbnail)
        $prodAds = Product::latest()->where('kategori', 'Barang Bekas')->get()[0];
        $products = (Product::latest()->where('kategori', 'Barang Bekas')->get())->toArray();
        unset($products[0]);

        //kategori 2 (thumbnail)
        $prodAds2 = Product::latest()->where('kategori', 'Bahan Kue')->get()[0];
        $products2 = (Product::latest()->where('kategori', 'Bahan Kue')->get())->toArray();
        unset($products2[0]);

        //kategori 3 (thumbnail)
        $prodAds3 = Product::latest()->where('kategori', 'Produk Digital')->get()[0];
        $products3 = (Product::latest()->where('kategori', 'Produk Digital')->get())->toArray();
        unset($products3[0]);

        //kategori 4 (thumbnail)
        $prodAds4 = Product::latest()->where('kategori', 'Fashion')->get()[0];
        $products4 = (Product::latest()->where('kategori', 'Fashion')->get())->toArray();
        unset($products4[0]);

        //kategori 5 (thumbnail)
        $prodAds5 = Product::latest()->where('kategori', 'Kesehatan')->get()[0];
        $products5 = (Product::latest()->where('kategori', 'Kesehatan')->get())->toArray();
        unset($products5[0]);

        //kategori 6 (thumbnail)
        $prodAds6 = Product::latest()->where('kategori', 'Sembako')->get()[0];
        $products6 = (Product::latest()->where('kategori', 'Sembako')->get())->toArray();
        unset($products6[0]);

        //kategori 7 (thumbnail)
        $prodAds7 = Product::latest()->where('kategori', 'Snack')->get()[0];
        $products7 = (Product::latest()->where('kategori', 'Snack')->get())->toArray();
        unset($products7[0]);

        return view('welcome', compact(
            'prodAds',
            'products',
            'prodAds2',
            'products2',
            'prodAds3',
            'products3',
            'prodAds4',
            'products4',
            'prodAds5',
            'products5',
            'prodAds6',
            'products6',
            'prodAds7',
            'products7'
        ));
    }

    public function cart()
    {

        return view('cart');
    }

    public function single()
    {
        return view('single');
    }
}
