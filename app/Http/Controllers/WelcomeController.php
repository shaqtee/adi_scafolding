<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        //$products = (Product::latest()->paginate(6));

        return view('welcome');
    }
}
