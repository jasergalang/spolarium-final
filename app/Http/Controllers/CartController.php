<?php

namespace App\Http\Controllers;

use App\Mail\OrderReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Material, Cart, Customer,Artwork, Order};
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
        {
            $userId = Auth::id();
            $customer = Customer::where('user_id', $userId)->first();
            $cart = $customer->cart;

            $materialQuantities = $cart->material()->pluck('cart_material.quantity', 'materials.id');
            $artworkQuantities = $cart->artwork()->pluck('artwork_cart.quantity', 'artworks.id');

            $totalPrice = 0;
            $totalPrice1 = 0;
            foreach ($cart->material as $material) {
                // Get the quantity of the current material
                $quantity = $materialQuantities[$material->id] ?? 0;
                $totalPrice += $material->price * $quantity;

            }
            foreach ($cart->artwork as $artwork) {
                // Get the quantity of the current artwork
                $quantity = $artworkQuantities[$artwork->id] ?? 0;
                $totalPrice1 += $artwork->price * $quantity;

            }

            return view('cart.index', compact('cart', 'totalPrice', 'totalPrice1', 'materialQuantities', 'artworkQuantities', 'customer'));

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
     * */
    //  public function store(Request $request)
    // {
    //     $userId = Auth::id();

    //     $customer = Customer::where('user_id', $userId)->first();
    //     $customerId = $customer->id;

    //     $cart = Cart::firstOrCreate(['customer_id' => $customerId]);
    //     $artworkId = $request->input('artwork_id');
    //     $materialId = $request->input('material_id');
    //     $quantity = $request->input('quantity_' . $materialId);

    //     // Check if the artwork and material are already in the cart
    //     // $existingArtwork = $cart->artwork()->where('artwork_id', $artworkId)->exists();
    //     // $existingMaterial = $cart->material()->where('material_id', $materialId)->exists();

    //     // if ($existingArtwork && $existingMaterial) {
    //     //     return redirect()->back()->with('error', 'Item already exists in the cart.');
    //     // }

    //     // Attach artwork and material to the cart
    //     $cart->artwork()->attach($artworkId, ['created_at' => now(), 'updated_at' => now()]);
    //     $cart->material()->attach($materialId, ['quantity' => $quantity, 'created_at' => now(), 'updated_at' => now()]);

    //     // Optionally, update the quantity of the material if it already exists in the cart
    //     // $cart->materials()->updateExistingPivot($materialId, ['quantity' => $newQuantity]);

    //     // Update material stock
    //     $material = Material::findOrFail($materialId);
    //     $material->stock -= $quantity;
    //     $material->save();

    //     return redirect()->back()->with('success', 'Item added to cart successfully.');
    // }
    public function addArtworkToCart(Request $request)
    {
        $userId = Auth::id();

        $customer = Customer::where('user_id', $userId)->first();
        $customerId = $customer->id;

        $cart = Cart::firstOrCreate(['customer_id' => $customerId]);
        $artworkId = $request->input('artwork_id');

        // Attach artwork to the cart
        $cart->artwork()->attach($artworkId, ['created_at' => now(), 'updated_at' => now()]);

        return redirect()->back()->with('success', 'Artwork added to cart successfully.');
    }

    public function addMaterialToCart(Request $request)
    {
        $userId = Auth::id();

        $customer = Customer::where('user_id', $userId)->first();
        $customerId = $customer->id;

        $cart = Cart::firstOrCreate(['customer_id' => $customerId]);
        $materialId = $request->input('material_id');
        $quantityFieldName = 'quantity_' . $materialId;
        $quantity = $request->input($quantityFieldName);

        // Ensure quantity is not null or empty
        if (!$quantity) {
            return redirect()->back()->with('error', 'Quantity cannot be empty.');
        }

        // Attach material to the cart
        $cart->material()->attach($materialId, ['quantity' => $quantity, 'created_at' => now(), 'updated_at' => now()]);

        // Update material stock
        // $material = Material::findOrFail($materialId);
        // $material->stock -= $quantity;
        // $material->save();

        return redirect()->back()->with('success', 'Material added to cart successfully.');
    }
    public function placeorder(Request $request)
    {
        $userId = Auth::id();

        $customer = Customer::where('user_id', $userId)->first();
        $customerId = $customer->id;

        $validatedData = $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:credit_card,paypal,bdo,gcash,paymaya,coins.ph',
        ]);

        $shippingAddress = $validatedData['shipping_address'];
        $paymentMethod = $validatedData['payment_method'];

        // Create a new order for the customer
        $order = new Order();
        $order->customer_id = $customerId;
        $order->status = 'pending';
        $order->shipping_address = $shippingAddress;
        $order->payment_method = $paymentMethod;
        $order->save();
        $order = Order::where('customer_id', $customerId)->first();

        // If no order exists, create a new one
        $order = new Order();
    $order->customer_id = $customerId;
    $order->status = 'pending';
    $order->shipping_address = $shippingAddress;
    $order->payment_method = $paymentMethod;
    $order->save();

        // Retrieve material quantities from the input fields
        $materialQuantities = session('material_quantities');
        foreach ($materialQuantities as $materialId => $quantity) {
            if ($quantity > 0) {
                // Insert ordered material into material_order pivot table
                $order->material()->attach($materialId, ['quantity' => $quantity]);
                // Update material stock
                $material = Material::findOrFail($materialId);
                $material->stock -= $quantity;
                $material->save();

                // Check if the stock is zero and update the status if necessary
                if ($material->stock <= 0) {
                    $material->status = 'out of stock';
                    $material->save();
                }

            }
        }

        // Retrieve artwork quantities from the input fields
        $artworkQuantities = session('artwork_quantities');
        foreach ($artworkQuantities as $artworkId => $quantity) {
            if ($quantity > 0) {
                // Insert ordered artwork into artwork_order pivot table
                $order->artwork()->attach($artworkId, ['quantity' => $quantity]);

                // Update artwork status to 'sold'
                $artwork = Artwork::findOrFail($artworkId);
                $artwork->status = 'sold';
                $artwork->save();
            }
        }
        $user = User::find($userId);

        $user->sendEmailOrderReceiptNotification($order);
        $customer->cart->artwork()->detach();
        $customer->cart->material()->detach();

        // Clear the session data for cart items
        session()->forget('artwork_quantities');
        session()->forget('material_quantities');
        return redirect()->back()->with('success', 'Order placed successfully!');
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
    public function destroyMaterial($id)
    {
        $userId = Auth::id();
        $customer = Customer::where('user_id', $userId)->first();
        $cart = $customer->cart;

        $cart->material()->detach($id);

        return redirect()->route('cart.index')->with('success', 'Material removed from cart successfully.');
    }

    public function destroyArtwork($id)
    {
        $userId = Auth::id();
        $customer = Customer::where('user_id', $userId)->first();
        $cart = $customer->cart;

        // Detach the specific artwork from the cart
        $cart->artwork()->detach($id);

        // Redirect back to the cart page after removal
        return redirect()->route('cart.index')->with('success', 'Artwork removed from cart successfully.');
    }


}
