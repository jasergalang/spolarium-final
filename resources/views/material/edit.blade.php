
@extends('layout.layout')

@section('content')

{{--  --}}
<form method="POST" action="{{ route('material.update', $material->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Add method spoofing for PUT request -->
<div class="container py-6 space-x-5 space-y-5 bg-white">
    <div class="grid grid-cols-2">
        <!-- Artwork Name -->
        <div class="p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Material Name</div>
            <div class="mx-5 my-10">
                <div class="text-base font-semibold mb-2">Material Name:</div>
                <input name="name" placeholder="Enter material"class="rounded-md border border-gray-300 p-2 w-full" value="{{ $material->name }}">
            </div>
        </div>

        <!-- Price -->
        <div class="p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Price</div>
            <div class="mx-5 my-10">
                <div class="text-base font-semibold">Price of Material:</div>
                <div class="flex items-center py-5">
                    <i class="fa-solid fa-peso-sign"></i>
                    <input type="text" name="price" placeholder="Enter material price " class="rounded-md border border-gray-300 ml-5 w-full"value="{{ $material->price }}">
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-2">
        <!-- Stock -->
        <div class="p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Material Stock</div>
            <div class="mx-5 my-10">
                <div class="text-base font-semibold mb-2">Material Stock:</div>
                <input name="stock" placeholder="Enter material stock"class="rounded-md border border-gray-300 p-2 w-full"value="{{ $material->stock }}">
            </div>
        </div>

        <!-- Description -->
        <div class="p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Description</div>
            <div class="mx-5 my-10">
                <div class="text-base font-semibold">Description:</div>
                <div class="flex items-center py-5">
                    <i class="fa-solid fa-peso-sign"></i>
                    <input type="text" name="desc" placeholder="Enter material description" class="rounded-md border border-gray-300 ml-5 w-full"value="{{ $material->desc }}">
                </div>
            </div>
        </div>
    </div>


    <!-- Category -->
    <div class="p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
        <div class="text-lg font-bold mb-4 border-b">Category</div>
        <div class="mx-5 my-10">
            <div class="text-base font-semibold mb-2">Material Category:</div>
            <select name="category" class="rounded-md border border-gray-300 p-2 w-full">
                <option>--Choose One--</option>
                <option @if($material->category == 'Painting Supplies') selected @endif>Painting Supplies</option>
                <option @if($material->category == 'Drawing Supplies') selected @endif>Drawing Supplies</option>
                <option @if($material->category == 'Sculpting Materials') selected @endif>Sculpting Materials</option>
                <option @if($material->category == 'Printmaking Supplies') selected @endif>Printmaking Supplies</option>
                <option @if($material->category == 'Photography Equipment') selected @endif>Photography Equipment</option>
                <option @if($material->category == 'Crafting Materials') selected @endif>Crafting Materials</option>
                <option @if($material->category == 'Digital Art Tools') selected @endif>Digital Art Tools</option>
            </select>
        </div>
    </div>

<div class="flex items-center justify-center mt-10 text-center">
    <label for="fileInput" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
        <input type="file" accept=".png, .jpg" id="fileInput" name="images[]" style="display: none;" multiple accept="image/*">
        <i class="bg-transparent text-gray-500 hover:text-red-500 font-bold h-24 w-full py-2 px-4 rounded-xl flex justify-center items-center">
            <i class="fa-solid fa-image mr-2"></i>
            Select Images
        </i>
    </label>
</div>

<div class="text-lg font-bold mb-5 my-10 mx-20 border-b">Existing Photos:</div>

<div id="imageContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach ($material->image as $images)
    <img src="{{ asset('/images/' . $images->image_path) }}" alt="Artwork Image">
    @endforeach
</div>

        {{-- Go Button --}}
        <button id="submitartworkdetails" class="uppercase bg-gray-700 hover:bg-red-500 border hover:border-red-500 text-white hover:text-white hover:scale-105 transition font-bold py-2 px-4 w-full h-24 rounded-md my-10 mx-auto block">
            Create Art Materials
        </button>

        <a href="{{ route('material.dashboard') }}" class="button">Go Back</a>
    </form>
</div>
</div>
</div>
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


