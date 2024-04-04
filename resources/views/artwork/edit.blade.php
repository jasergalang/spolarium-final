@extends('layout.layout')

@section('content')

<form method="POST" action="{{ route('artwork.update', $artwork->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Add method spoofing for PUT request -->

    <div class="container py-6 space-x-5 space-y-5 bg-white">
        <div class="grid grid-cols-2">
            <!-- Artwork Name -->
            <div class="p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
                <div class="text-lg font-bold mb-4 border-b">Artwork Name</div>
                <div class="mx-5 my-10">
                    <div class="text-base font-semibold mb-2">Artwork Name:</div>
                    <input name="artwork_name" placeholder="Enter artwork" class="rounded-md border border-gray-300 p-2 w-full" value="{{ $artwork->name }}">
                </div>
            </div>

            <!-- Price -->
            <div class="p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
                <div class="text-lg font-bold mb-4 border-b">Price</div>
                <div class="mx-5 my-10">
                    <div class="text-base font-semibold">Price of Art:</div>
                    <div class="flex items-center py-5">
                        <i class="fa-solid fa-peso-sign"></i>
                        <input type="text" name="art_price" placeholder="Enter artwork price " class="rounded-md border border-gray-300 ml-5 w-full" value="{{ $artwork->price }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Description</div>
            <div class="mx-5 my-10">
                <div class="text-base font-semibold mr-1 mb-2">Description:</div>
                <input type="text" name="art_description" placeholder="Enter artwork description" class="rounded-md border border-gray-300 w-full h-20" value="{{ $artwork->desc }}">
            </div>
        </div>
        <div class="p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Size</div>
            <div class="mx-5 my-10">
                <div class="text-base font-semibold mr-1 mb-2">Size:</div>
                <input type="text" name="art_size" placeholder="Enter artwork size" class="rounded-md border border-gray-300 w-full h-20" value="{{ $artwork->size }}">
            </div>
        </div>
        <!-- Category -->
        <div class="p-6 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Category</div>
            <div class="mx-5 my-10">
                <div class="text-base font-semibold mb-2">Art Category:</div>
                <select name="art_category" class="rounded-md border border-gray-300 p-2 w-full">
                    <option>--Choose One--</option>
                    <option @if($artwork->category == 'Painting') selected @endif>Painting</option>
                    <option @if($artwork->category == 'Print Making') selected @endif>Print Making</option>
                    <option @if($artwork->category == 'Photography') selected @endif>Photography</option>
                    <option @if($artwork->category == 'Sculpture') selected @endif>Sculpture</option>
                    <option @if($artwork->category == 'Drawing') selected @endif>Drawing</option>
                    <option @if($artwork->category == 'Digital Art') selected @endif>Digital Art</option>
                    <option @if($artwork->category == 'Collage') selected @endif>Collage</option>
                </select>
            </div>
        </div>

        <div class="p-6 pt-5 bg-white hover:scale-105 hover:shadow-2xl rounded-2xl transition mx-5">


        </div>

        <!-- Selected Photos -->
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

        <div id="imageContainer" class="grid grid-cols-1e sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($artwork->image as $images)
            <img src="{{ asset('/images/' . $images->image_path) }}" alt="Artwork Image">
            @endforeach
        </div>

        <!-- Update Button -->
        <button id="submitartworkdetails" class="uppercase bg-gray-700 hover:bg-red-500 border hover:border-red-500 text-white hover:text-white hover:scale-105 transition font-bold py-2 px-4 w-full h-24 rounded-md my-10 mx-auto block">
            Update Artwork
        </button>
        <a href="{{ route('artwork.dashboard') }}" class="button">Go Back</a>
    </div>
</form>
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
