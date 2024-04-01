<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderCRUDController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orderManagement.index', compact('orders'));
    }

    public function create()
    {
        return view('orderManagement.create');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            // Define your validation rules here
        ]);

        // Create new order
        Order::create($request->all());

        return redirect()->route('orderManagement.index')->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        return view('orderManagement.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        // Validation
        $request->validate([
            // Define your validation rules here
        ]);

        // Update the order
        $order->update($request->all());

        return redirect()->route('orderManagement.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        // Delete the order
        $order->delete();

        return redirect()->route('orderManagement.index')->with('success', 'Order deleted successfully.');
    }
}