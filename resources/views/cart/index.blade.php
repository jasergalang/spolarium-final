@extends('layout.layout')

@section('content')
@include('layout.cusHeader')
@include('layout.cusNav')
<!-- Checkout Form -->
<form action="{{ route('order.store') }}" method="POST">
    @csrf
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-8">Checkout</h1>

        <!-- Billing and Shipping Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Billing Information -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Billing Information</h2>
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" id="name" name="name" class="form-input" placeholder="John Doe" value="{{ Auth::user()->fname }} {{ Auth::user()->lname }}" disabled>
                </div>
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="example@example.com" value="{{ Auth::user()->email }}" disabled>
                </div>
                <!-- Contact -->
                <div class="mb-4">
                    <label for="contact" class="block text-gray-700">Contact</label>
                    <input type="text" id="contact" name="contact" class="form-input" placeholder="Phone number" value="{{ Auth::user()->contact }}" disabled>
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
            </div>
        </div>

        <!-- Order Summary -->
        <div>
            <h1 class="text-3xl font-bold mb-4">Order Summary</h1>
            <div class="md:col-span-1">
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <div class="border-b-2 border-gray-300 pb-2 mb-4">
                        <p class="text-lg">Total Items: {{ $cart->material->count() + $cart->artwork->count() }}</p>
                        <p class="text-lg">Total Price: ${{ $totalPrice + $totalPrice1 }}</p> <!-- Display the total price -->
                    </div>
                    <div class="flex justify-end">
                        <button class="btn btn-success"><i class="fas fa-cart-shopping"></i> Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>


</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<!-- Cart Form -->
<div class="container mx-auto mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Product List -->
    <div>
        <h1 class="text-3xl font-bold mb-4">Your Cart</h1>
        <!-- Loop through materialss -->
        @foreach ($cart->material->unique('id') as $materials)
        <div class="bg-white p-2 rounded-lg shadow-md mb-4 flex items-center justify-between">
            <div class="flex items-center">
                <input type="" name="selected_materials[]" class="mr-2">
                <img src="{{ asset('images/' . $materials->image->first()->image_path) }}" alt="{{ $materials->name }}" class="w-24 h-24 object-cover">
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">{{ $materials->name }}</h2>
                    <p class="text-gray-500">${{ $materials->price }}</p>
                    <!-- Quantity input -->
                    <div class="mt-2">
                        <label for="quantity_{{ $materials->id }}" class="text-gray-600">Quantity:</label>
                        <input type="hidden" id="quantity_{{ $materials->id }}" name="material_quantities[{{ $materials->id }}]"  value="{{ $materialQuantities[$materials->id] ?? 0 }}" min="1" class="w-20 px-2 py-1 border rounded-md">
                    </div>
                </div>
            </div>
            <form action="{{ route('cart.material.destroy', $materials->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Remove</button>
            </form>

        </div>
        @endforeach
        <!-- Loop through artworkss -->
        @foreach ($cart->artwork->unique('id') as $artworks)
        <div class="bg-white p-2 rounded-lg shadow-md mb-4 flex items-center justify-between">
            <div class="flex items-center">
                <input type="checkbox"name="selected_artworks[]" class="mr-2" >
                <img src="{{ asset('images/' . $artworks->image->first()->image_path) }}" alt="{{ $artworks->name }}" class="w-24 h-24 object-cover">
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">{{ $artworks->name }}</h2>
                    <p class="text-gray-500">${{ $artworks->price }}</p>
                    <!-- Quantity input -->
                    <div class="mt-2">
                        <label for="quantity_{{ $artworks->id }}" class="textl-gray-600">Quantity:</label>
                        <input type="hidden" id="quantity_{{ $artworks->id }}" name="artwork_quantities[{{ $artworks->id }}]"  value="{{ $artworkQuantities[$artworks->id] ?? 0 }}" min="1" class="w-20 px-2 py-1 border rounded-md" disabled>
                    </div>
                </div>
            </div>
            <form action="{{ route('cart.artwork.destroy', $artworks->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Remove</button>
            </form>
        </div>
        @endforeach

    </form>
    @php
    session()->put('artwork_quantities', $artworkQuantities);
    session()->put('material_quantities', $materialQuantities);

@endphp

    </div>

<!-- Bootstrap JS (Optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
@endsection

@section('scripts')
    @parent

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
    @if(session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif

    @if ($errors->any())
        <script>
            var errorMessage = @json($errors->all());
            alert(errorMessage.join('\n'));
        </script>
    @endif
@endsection
