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
        $records = Record::with('product')->get();

        return view('records.index', compact('records'));
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
        // $recordss = Record::create($validatedData);

        // $productIds = $request->cart;
        // example: [1, 5, 10]
        // $cart = session()->get('cart', []);
        $cart = session()->get('cart', []);
        $productIds = array_keys(session()->get('cart', []));
        $productNames = array_column($cart, 'name');
        $productQuantity = array_column($cart, 'quantity');
        $productSize = array_column($cart, 'size');
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
            'size' => json_encode($productSize),
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
    public function show(Record $record)
    {
        $productIds   = json_decode($record->product_id, true) ?? [];
        $productNames = json_decode($record->name, true) ?? [];
        $productSize = json_decode($record->size, true) ?? [];
        $quantities   = json_decode($record->quantity, true) ?? [];
        $subtotals    = json_decode($record->subtotal, true) ?? [];

        $products = [];

        $count = max(
            count($productIds),
            count($productNames),
            count($productSize),
            count($quantities),
            count($subtotals)
        );

        for ($i = 0; $i < $count; $i++) {
            $products[] = [
                'id'       => $productIds[$i] ?? 'Unknown',
                'name'     => $productNames[$i] ?? 'No Product',
                'size'     => $productSize[$i] ?? 0,
                'quantity' => $quantities[$i] ?? 0,
                'subtotal' => $subtotals[$i] ?? 0,
            ];
        }


        if (empty($productIds)) {
            return view('records.show', [
                'record' => $record,
                'products' => [],
            ]);
        } else {

            return view('records.show', compact('record', 'products'));
        }
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
