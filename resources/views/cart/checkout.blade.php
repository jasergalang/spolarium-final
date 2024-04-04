@extends('layout.layout')

@section('content')
@include('layout.artHeader')
@include('layout.artNav')

<!-- Checkout Form -->
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-8">Checkout</h1>
    <form action="/checkout" method="post">
        @csrf
        <!-- Billing and Shipping Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Billing Information -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Billing Information</h2>
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" id="name" name="name" class="form-input" placeholder="John Doe" disabled>
                </div>
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="example@example.com" disabled>
                </div>
                <!-- Contact -->
                <div class="mb-4">
                    <label for="contact" class="block text-gray-700">Contact</label>
                    <input type="text" id="contact" name="contact" class="form-input" placeholder="Phone number" disabled>
                </div>
            </div>
            <!-- Shipping Information -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>
                <!-- Shipping Address -->
                <div class="mb-4">
                    <label for="shipping_address" class="block text-gray-700">Shipping Address</label>
                    <textarea id="shipping_address" name="shipping_address" class="form-textarea" rows="3" placeholder="123 Main St, City, Country" required></textarea>
                </div>
            </div>
        </div>
        <!-- Payment Information -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Payment Information</h2>
            <!-- Payment Method Dropdown -->
            <div class="mb-4">
                <label for="payment_method" class="block text-gray-700">Payment Method</label>
                <select id="payment_method" name="payment_method" class="form-select" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bdo">BDO</option>
                    <option value="gcash">Gcash</option>
                    <option value="paymaya">PayMaya</option>
                    <option value="coins.ph">Coins.ph</option>
                </select>
            </div>
            <!-- Card Number -->
            <div class="mb-4">
                <label for="card_number" class="block text-gray-700">Card Number</label>
                <input type="text" id="card_number" name="card_number" class="form-input" placeholder="**** **** **** ****" required>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <!-- Expiry Date -->
                <div class="mb-4">
                    <label for="expiry_date" class="block text-gray-700">Expiry Date</label>
                    <input type="text" id="expiry_date" name="expiry_date" class="form-input" placeholder="MM/YY" required>
                </div>
                <!-- CVV -->
                <div class="mb-4">
                    <label for="cvv" class="block text-gray-700">CVV</label>
                    <input type="text" id="cvv" name="cvv" class="form-input" placeholder="123" required>
                </div>
            </div>
        </div>
        <!-- Submit Button -->
        <div class="flex justify-end fixed bottom-0 right-0 mb-8 mr-8">
            <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-cart-arrow-down"></i> Place Order</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
@endsection
