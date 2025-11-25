<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{


    public function index(): View
    {
        $products = Product::all();

        $cart = session()->get('cart') ?? [];
        $count = count($cart);

        return view('pages.index', [
            'products' => $products,
            'count' => $count,
            'cart' => $cart,     // ← ADD THIS

        ]);
    }
}
