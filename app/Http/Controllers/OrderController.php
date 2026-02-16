<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();
        $cart = session()->get('cart') ?? [];
        $count = count($cart);

        // SEARCH FILTER
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $words = explode(' ', $search);

            $query->where(function ($q) use ($words) {
                foreach ($words as $word) {
                    $q->orWhereRaw('LOWER(name) LIKE ?', ['%' . $word . '%']);
                    $q->orWhereRaw('LOWER(category) LIKE ?', ['%' . $word . '%']);
                }
            });
        }


        // CATEGORY FILTER (optional)
        if ($request->filled('category') && $request->category !== 'all') {
            if ($request->category === 'none') {
                $query->whereNull('category')->orWhere('category', '');
            } else {
                $query->where('category', $request->category);
            }
        }

        $products = $query->get();

        // Get categories for menu
        // $categories = Product::select('category')
        //     ->whereNotNull('category')
        //     ->where('category', '!=', '')
        //     ->distinct()
        //     ->pluck('category');
        $categories = Product::select('category')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->groupBy('category')
            ->orderByRaw('MIN(id) asc')
            ->pluck('category');


        return view('order.index', compact('products', 'categories', 'cart', 'count'));
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
