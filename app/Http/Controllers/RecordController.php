<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Product;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $record = Record::with('product')->get();

        return view('records.index', compact('record'));
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
        // $validatedData = $request->validate([
        //     'product_id' => 'required|exists:product_listings,id',
        //     'ids' => 'required|array',
        //     'ids.*' => 'integer'
        // ]);

        // $product = Product::findOrFail($validatedData['product_id']);
        // $cart = session()->get('cart', []);

        // session()->put('cart', $cart);
        // $record = Record::create($validatedData);

        // $productIds = $request->cart;
        // example: [1, 5, 10]
        // $cart = session()->get('cart', []);
        $cart = session()->get('cart', []);
        $productIds = array_keys(session()->get('cart', []));
        $productNames = array_column($cart, 'name');
        $productQuantity = array_column($cart, 'quantity');
        $productPrice = array_column($cart, 'price');


        $total = session()->get('cart_total');
        $subtotals = [];

        foreach ($cart as $id => $item) {
            // Use null coalescing operator to avoid undefined key error
            $itemSubtotal = $item['subtotal'] ?? ($item['price'] * $item['quantity']);
            $subtotals[] = $itemSubtotal;
        }
        Record::create([
            'product_id' => json_encode($productIds),
            'name' => json_encode($productNames),
            'price' => json_encode($productPrice),
            'quantity' => json_encode($productQuantity),
            'subtotal' => json_encode($subtotals),
            'total' => json_encode($total),
        ]);

        // clear cart after saving
        session()->forget('cart');

        return 'saved!';
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record) // singular
    {
        // Decode JSON arrays
        $productIds   = json_decode($record->product_id, true);
        $productNames = json_decode($record->name, true);
        $quantities   = json_decode($record->quantity, true);
        $subtotals    = json_decode($record->subtotal, true);

        // Combine arrays into products
        $products = [];
        for ($i = 0; $i < count($productIds); $i++) {
            $products[] = [
                'id'       => $productIds[$i] ?? null,
                'name'     => $productNames[$i] ?? 'No Product',
                'quantity' => $quantities[$i] ?? 0,
                'subtotal' => $subtotals[$i] ?? 0,
            ];
        }
        dd($record, $products);

        // Pass $products and $record to Blade
        return view('records.show', compact('record', 'products'));
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
