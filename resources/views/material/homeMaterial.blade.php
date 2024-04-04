@extends('layout.layout')

@section('content')
{{-- Artistic banner --}}
@include('layout.cusHeader')

@include('layout.cusNav')


<div class="container mb-10 grid grid-cols-3 gap-3">

    @foreach($materials as $material)
        <div class="bg-white shadow rounded overflow-hidden group">
            <!-- Assuming Material has an 'image' relationship -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($material->image as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('images/' . $image->image_path) }}" alt="Material Image" class="w-96 h-52">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="pt-4 pb-3 px-4">
                <a href="#" onclick="openModal('{{ $material->id }}')">
                    <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">{{ $material->name }}</h4>
                </a>
                <div class="flex items-baseline mb-1 space-x-2 font-roboto">
                    <p class="text-xl text-primary font-semibold">
                        <span class="text-gray-600">Price:</span> <span class="text-gray-600 font-bold">${{ $material->price }}</span>
                        <br>
                        <span class="text-gray-600">Status:</span> <span class="text-green-600 font-bold">{{ $material->status }}</span>
                    </p>
                </div>
                <!-- "View Detail" button -->

                @include('material.show')
            </div>
        </div>
    @endforeach

</div>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    window.addEventListener('load', function() {
        var swiperContainers = document.querySelectorAll('.swiper-container');
        swiperContainers.forEach(function (swiperContainer) {
            var swiper = new Swiper(swiperContainer, {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        });
    });
</script>

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
