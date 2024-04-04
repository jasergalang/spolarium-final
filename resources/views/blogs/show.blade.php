@extends('layout.layout')

{{-- Artistic banner --}}
@include('layout.cusHeader')

@include('layout.cusNav')

<!-- Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Latest Blog Posts</h1>
        @foreach($blogs as $blog)
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg overflow-hidden my-8">
            <div class="grid grid-cols-2 gap-4">
                @if($blog->images)
                <div>
                    <img src="{{ asset('images/'. ($blog->image->first()->image_path)) }}" alt="{{ $blog->title }}" class="rounded-lg object-cover w-full h-full">
                </div>
                @endif
                <div class="p-6">
                    <h3 class="text-3xl font-semibold text-gray-800 mb-4">{{ $blog->title }}</h3>
                    <p class="text-gray-700 text-lg leading-relaxed mb-6">{{ $blog->content }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>
