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
        $products = Product::all();
        $cart = session()->get('cart', []);
        $cart = session()->get('cart') ?? [];
        $count = count($cart);
        $records = Record::with('product')->get();


        $records = Record::with('product')->get();

        foreach ($records as $record) {
            // Ensure name and quantity are arrays
            $namesArray = is_array($record->name) ? $record->name : json_decode($record->name, true);
            $quantityArray = is_array($record->quantity) ? $record->quantity : json_decode($record->quantity, true);

            // Clean arrays
            $namesArray = array_filter($namesArray, fn($n) => !empty($n));
            $quantityArray = array_filter($quantityArray, fn($q) => !empty($q));

            // Take first 3 items
            $firstThreeNames = array_slice($namesArray, 0, 3);
            $firstThreeQty = array_slice($quantityArray, 0, 3);

            // Combine names and quantities
            $summary = [];
            for ($i = 0; $i < count($firstThreeNames); $i++) {
                $qty = $firstThreeQty[$i] ?? 1; // default 1 if missing
                $summary[] = $firstThreeNames[$i] . ' x' . $qty;
            }

            $record->summary = implode(', ', $summary);

            // Add gray dots if more than 3 items
            if (count($namesArray) > 3) {
                $record->summary .= ' <span class="text-gray-400">...</span>';
            }
        }

        return view('records.index', [
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
        $products = Product::all();
        $cart = session()->get('cart', []);
        $cart = session()->get('cart') ?? [];
        $count = count($cart);


        $records = Record::with('product')->get();

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
                'count' => $count,
                'cart' => $cart
            ]);
        } else {

            return view('records.show', [
                'record' => $record,
                'products' => $products,
                'count' => $count,
                'cart' => $cart
            ]);
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
