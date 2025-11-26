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
        $products = Product::all();

        return view('menu.index')->with('products', $products);
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
        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {

        return view('menu.show')->with('product', $product);
    }
    //  public function show($id): View
    // {
    //     $product = Product::findOrFail($id); // ✅ makes sure it exists
    //     return view('menu.show', compact('product'));
    // }
    /**
     * Show the form for editing the specified resource.
     */
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


        return redirect::route('pages.index')->with('success', 'Job deleted successfully.');
    }
}
