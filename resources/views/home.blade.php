@extends('layout.layout')

@section('content')
{{-- Artistic banner --}}
@include('layout.cusHeader')

@include('layout.cusNav')
   <div class="bg-cover bg-no-repeat bg-center py-36" style="background-image: url('https://images.pexels.com/photos/1292241/pexels-photo-1292241.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')">
        <div class="container">
            <h1 class="text-4xl text-white font-medium mb-4">
                Art Gallery
            </h1>
            <p class="text-xl text-white font-medium mb-4">
                Welcome to the world of art, where every brushstroke tells a story,<br>
                and every canvas is a window to the soul.
            </p>
            <div class="mt-12 hover:scale-105 hover:shadow-2xl transition">
                <a href="#" class="bg-red-500 text-white px-8 py-3 font-medium rounded-2xl border border-white hover:text-white">Explore Art</a>
            </div>
        </div>
   </div>
{{-- End of artistic banner --}}







{{-- End of Browse Art by Categories --}}
<div class="container py-16">
<h2 class="text-3xl font-medium text-gray-800 mb-6">Browse Artworks</h2>
@include('artwork.index')
</div>

<div class="container py-16">
<h2 class="text-3xl font-medium text-gray-800 mb-6">Shop for Art Materials</h2>
@include('material.index')
</div>

{{-- @include('showmodal') --}}


{{-- Art-related Q&A --}}
<div class="bg-white pt-16 pb-12 border-t border-gray-100">
    <div class="container grid grdi-cols-1 py-4">
        <h3 class="text-black font-semibold text-xl py-5">Art: A Journey into Creativity</h3>
        <p class="text-gray-800 font-medium text-justify">
            Explore the world of art where creativity knows no bounds. Dive into the depths of imagination and emotion through the strokes of a brush or the lines of a sculpture.
            <br><br>
            Art transcends boundaries, offering a unique lens through which to view the world and understand the human experience. Join us on this journey of discovery and inspiration.
        </p>

        <h3 class="text-black font-semibold text-xl py-5">Art Rental: Bringing Masterpieces to Your Home</h3>
        <p class="text-gray-800 font-medium text-justify">
            Renting art allows you to bring the beauty of masterpieces into your home without the commitment of ownership. Whether you're looking to decorate your space or simply appreciate the work of talented artists, art rental offers a flexible and accessible way to enjoy art.
            <br><br>
            With a wide range of styles and mediums available for rent, you can curate your own personal gallery and rotate artworks to suit your mood and style. Experience the joy of living with art and let it inspire and enrich your life every day.
        </p>
    </div>
</div>
{{-- End of Art-related Q&A --}}

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
