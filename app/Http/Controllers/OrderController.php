<?php

namespace App\Http\Controllers;

use App\Models\{Order, Material, Artwork, Customer,};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();

        return view('order.index', ['orders' => $orders]);
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

        $userId = Auth::id();

        $customer = Customer::where('user_id', $userId)->first();
        $customerId = $customer->id;

        $order = Order::firstOrCreate(['customer_id' => $customerId]);
        $validatedData = $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:credit_card,paypal,bdo,gcash,paymaya,coins.ph',
            // Add validation rules for other fields as needed
        ]);

        // Once validated, you can access the data from $validatedData array
        $shippingAddress = $validatedData['shipping_address'];
        $paymentMethod = $validatedData['payment_method'];

        $order->shipping_address = $shippingAddress;
        $order->payment_method =  $paymentMethod ;
        $order->status = 'pending'; // Set the initial status as pending
        $order->save();

        // Retrieve material quantities from the input fields
        $materialQuantities = $request->input('material_quantities');
        foreach ($materialQuantities as $materialId => $quantity) {
            if ($quantity > 0) {
                // Insert ordered material into material_order pivot table
                $order->materials()->attach($materialId, ['quantity' => $quantity]);
                // Update material stock
                $material = Material::findOrFail($materialId);
                $material->stock -= $quantity;
                $material->save();
            }
    }

    // Retrieve artwork quantities from the input fields
    $artworkQuantities = $request->input('artwork_quantities');
    foreach ($artworkQuantities as $artworkId => $quantity) {
        if ($quantity > 0) {
            // Insert ordered artwork into artwork_order pivot table
            $order->artworks()->attach($artworkId, ['quantity' => $quantity]);
        }
    }
    return redirect()->back()->with('success', 'Order placed successfully!');
    }

    /**
     * Display the specified resource.
     */

     public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Check which button is clicked
        if ($request->has('delivered')) {
            $order->status = 'Delivered';
        } elseif ($request->has('cancelled')) {
            $order->status = 'Cancelled';
        }

        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Check which button is clicked
       if ($request->has('cancelled')) {
            $order->status = 'Cancelled';
        }

        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
    public function show( )
    {
        $id = Auth::id();
        $customer = Customer::where('user_id', $id)->first();

        if (!$customer) {
            abort(404, 'Customer not found.');
        }

        $customerId = $customer->id;
        $orders = Order::where('customer_id', $customerId)->get();

        return view('order.show', ['orders' => $orders]);
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
