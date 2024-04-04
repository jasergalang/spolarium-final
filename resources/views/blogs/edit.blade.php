@extends('layout.layout')

@section('content')
@include('layout.artHeader')
@include('layout.artNav')
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-8">Edit Blog</h1>
        <div class="card shadow-lg rounded-lg">
            <div class="card-body p-8">
            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
                    <div class="mb-6">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Blog Title</label>
                        <input type="text" class="form-control rounded-md border-gray-300 w-full py-2 px-4 focus:outline-none focus:border-blue-400" id="title" name="title" value="{{ $blog->title }}"
                            required>
                    </div>
                    <div class="mb-6">
                        <label for="content" class="block text-gray-700 font-bold mb-2">Blog Content</label>
                        <textarea class="form-control rounded-md border-gray-300 w-full py-2 px-4 focus:outline-none focus:border-blue-400" id="content" name="content" rows="4"
                            required>{{ $blog->content }}</textarea>
                    </div>
                    <div class="mb-6">
    <label for="image" class="block text-gray-700 font-bold mb-2">Images</label>
    <input type="file" class="form-control rounded-md border-gray-300 w-full py-2 px-4 focus:outline-none focus:border-blue-400" id="image" name="images[]" multiple>
</div>

                    <!-- Display existing image -->
                    <div class="mb-6">
                        <label for="existing_image" class="block text-gray-700 font-bold mb-2">Existing Image</label>
                        @if ($blog->image->isNotEmpty())
    <div style="display: flex;">
        @foreach ($blog->image as $image)
            <img src="{{ asset('images/'. $image->image_path) }}" alt="{{ $blog->title }}" style="max-width: 100px; max-height: 100px; margin-right: 10px;">
        @endforeach
    </div>
@else
    No Image
@endif

                    </div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>

</html>
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

