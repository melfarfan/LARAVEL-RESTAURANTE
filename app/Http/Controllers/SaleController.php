<?php


// app/Http/Controllers/SaleController.php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
   {
       $sales = Sale::with('user')->paginate(10);
       return view('sales.index', compact('sales'));
   }

    public function create()
    {
        $users = User::all(); 
        $customers = Customer::all();
        $products = Product::all();
        return view('sales.create', compact('users','customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'numeric|min:0',
        ]);

        $sale = Sale::create([
            'user_id' => $request->user_id,
            'customer_id' => $request->customer_id,
            'total_amount' => 0,
        ]);

        $totalAmount = 0;

        foreach ($request->product_id as $index => $productId) {
            $quantity = $request->quantity[$index];
            $unitPrice = $request->unit_price[$index];
            $subtotal = $quantity * $unitPrice;
            $totalAmount += $subtotal;

            SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
            ]);

           
        }

        $sale->update(['total_amount' => $totalAmount]);

        // return redirect()->route('sales.show', $sale->id);

        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }

    public function edit($id)
    {
        // $sale = Sale::with('saleDetails')->findOrFail($id);
        // $customers = Customer::all();
        // $products = Product::all();
        // return view('sales.edit', compact('sale', 'customers', 'products'));

        $sale = Sale::find($id);
        $users = User::all(); // Obtén todos los usuarios para el select
    
        return view('sales.edit', compact('sale', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'numeric|min:0',
        ]);

        $sale = Sale::findOrFail($id);
        $sale->update([
            'customer_id' => $request->customer_id,
            'total_amount' => 0,
        ]);

        $sale->saleDetails()->delete();

        $totalAmount = 0;

        foreach ($request->product_id as $index => $productId) {
            $quantity = $request->quantity[$index];
            $unitPrice = $request->unit_price[$index];
            $subtotal = $quantity * $unitPrice;

            SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
            ]);

            $totalAmount += $subtotal;
        }

        $sale->update(['total_amount' => $totalAmount]);

        return redirect()->route('sales.show', $sale->id);
    }

    // public function show($id)
    // {
    //     $sale = Sale::with('saleDetails.product')->findOrFail($id);
    //     return view('sales.show', compact('sale'));
    // }

    public function show(Sale $sale)
   {
    dd($sale);
    // $sale->load('customer', 'saleDetails.product'); // Carga las relaciones necesarias
    // return view('sales.show', compact('sale'));
   }



}


