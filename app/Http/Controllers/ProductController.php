<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\View\Components\Search;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use phpDocumentor\Reflection\Location;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //@desc Show menu listings
        //@route GET / menu

        $coffee = Product::where('category', 'Coffee')->get();
        $nonCoffee = Product::where('category', 'Non Coffee')->get();
        $milkySeries = Product::where('category', 'Milky Series')->get();
        $snackMenu = Product::where('category', 'Snack Menu')->get();
        $classicWaffle = Product::where('category', 'Classic Waffle')->get();
        $premiumWaffle = Product::where('category', 'Premium Waffle')->get();


        $products = Product::all();

        return view('menu.index')->with(
            'products',
            $products,
            'coffee',
            $coffee,
            'nonCoffee',
            $nonCoffee,
            'milkySeries',
            $milkySeries,
            'snackMenu',
            $snackMenu,
            'classicWaffle',
            $classicWaffle,
            'premiumWaffle',
            $premiumWaffle
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cart = session()->get('cart') ?? [];
        $count = count($cart);
        $products = Product::all();
        $categories = $products->pluck('category')->unique();

        return view('menu.createProducts', [
            'count' => $count,
            'cart' => $cart,
            'categories' => $categories     // ← ADD THIS
        ]);
    }
    private function resolveCategory(Request $request)
    {
        return $request->category === 'other'
            ? $request->custom_category
            : $request->category;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'flavor' => 'required|string',
            'category' => 'required',
            'custom_category' => 'required_if:category,Other',
            'size' => 'required|string',
            'price' => 'required|integer',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        // Use function
        $validatedData['category'] = $this->resolveCategory($request);
        $path = $request->file('avatar')->store('avatar', 'public');

        // Add path to validated data
        $validatedData['avatar'] = $path;
        Product::create($validatedData);
        return redirect()->route('menu.products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {

        return view('menu.show')->with('product', $product);
    }
    //show all products
    public function menuProducts(Product $product): View
    {

        $coffee = Product::where('category', 'Coffee')->get();
        $nonCoffee = Product::where('category', 'Non Coffee')->get();
        $milkySeries = Product::where('category', 'Milky Series')->get();
        $snackMenu = Product::where('category', 'Snack Menu')->get();
        $classicWaffle = Product::where('category', 'Classic Waffle')->get();
        $premiumWaffle = Product::where('category', 'Premium Waffle')->get();

        $products = Product::all(); // or filter by category
        $cart = session()->get('cart', []);
        $cart = session()->get('cart') ?? [];
        $count = count($cart);

        return view('menu.menuProduct', [
            'products' => $products,
            'count' => $count,
            'coffee' => $coffee,
            'nonCoffee' => $nonCoffee,
            'milkySeries' => $milkySeries,
            'snackMenu' =>  $snackMenu,
            'classicWaffle' => $classicWaffle,
            'premiumWaffle' => $premiumWaffle
        ]);
    }

    public function edit(Product $product): View
    {
        return view('menu.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'flavor' => 'required|string',
            'category' => 'nullable|string',
            'size' => 'required|string',
            'price' => 'required|integer',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        if ($request->hasFile('avatar')) {
            // Delete the old logo if it exists
            Storage::disk('public')->delete($product->avatar);


            // Store the logo and get the filename
            $logoPath = $request->file('avatar')->store('avatar', 'public');

            // Add path to validated data
            $validatedData['avatar'] = $logoPath;
        }


        $product->update($validatedData);
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        if ($product->avatar) {
            Storage::disk('public')->delete($product->avatar);
        }

        $product->delete();

        //check if the request came from the dashboard
        // if (request()->query('from') == 'dashboard') {

        //     return redirect::route('dashboard')->with('success', 'Job deleted successfully.');
        // }

        return redirect()->route('menu.products');

        // return redirect::route('menu.menuProduct')->with('success', 'Job deleted successfully.');
    }
}
