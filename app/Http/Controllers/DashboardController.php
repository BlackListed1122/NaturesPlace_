<?php

namespace App\Http\Controllers;


use App\Models\Record;
use App\Models\Product;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $cart = session()->get('cart', []);
        $cart = session()->get('cart') ?? [];
        $count = count($cart);
        $records = Record::with('product')->get();


        return view('dashboard.index', [
            'records' => $records,
            'products' => $products,
            'count' => $count,
            'cart' => $cart,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
