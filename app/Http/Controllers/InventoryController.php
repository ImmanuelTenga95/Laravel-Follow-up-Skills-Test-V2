<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        $totalValue = $products->sum(function ($product) {
            $total = $product->quantity_in_stock * $product->price_per_item;
            return $total;
        });

        return view('home', compact('products', 'totalValue'));
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
        // dd($request->all());

        $validated = $request->validate([
            'name' => 'required|string',
            'quantity_in_stock' => 'required|integer',
            'price_per_item' => 'required|integer',
        ],
    );



        $product = Product::create([
            'name' => $validated['name'],
            'quantity_in_stock' => $validated['quantity_in_stock'],
            'price_per_item' => $validated['price_per_item'],
        ]);

        if ($product) {

            return response()->json(['message' => 'Task created successfully'], 201);
        }
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
