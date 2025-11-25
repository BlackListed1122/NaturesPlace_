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

class CartController extends Controller
{
    // 🧾 Show Cart Summary
    public function index()
    {
        $cart = session()->get('cart', []);
        $cart = session()->get('cart') ?? [];
        $count = count($cart);
        return view('cart.index', [
            'count' => $count,
            'cart' => $cart,     // ← ADD THIS

        ]);
    }

    // 🛒 Add to Cart
    public function add(Request $request)
    {


        $validated = $request->validate([
            'product_id' => 'required|exists:product_listings,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $cart = session()->get('cart', []);

        // ✅ If item already in cart → update quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $validated['quantity'];
        } else {
            // ✅ Add new item
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $validated['quantity'],
                'image' => $product->avatar,
            ];
        }


        session()->put('cart', $cart);

        return redirect()->route('orders.index');
    }

    // ❌ Remove item from cart
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        // Remove item by ID
        unset($cart[$id]);

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item removed.');
    }
    public function clearCart()
    {
        // Remove the entire cart from session
        session()->forget('cart');

        return redirect()->back()->with('success', 'All items have been removed from the cart.');
    }


    public function checkout()
    {
        $cart = session()->get('cart');

        // force cart to be array always
        if (!is_array($cart)) {
            $cart = [];
        }

        $subtotals = [];
        $total = 0;

        foreach ($cart as $id => $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $cart[$id]['subtotal'] = $subtotal;

            $subtotals[] = $subtotal;
            $total += $subtotal;
        }

        // store for another controller
        session()->put('cart_with_totals', $cart);
        session()->put('cart_total', $total);
        $count = count($cart);

        return view('cart.index', compact('cart', 'total', 'count'));
    }
}
