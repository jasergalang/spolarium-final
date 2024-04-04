@extends('layout.layout')
@section('content')
@include('layout.artHeader')
@include('layout.artNav')
<!-- Main Content -->
<div class="container mx-auto mt-8">
    <!-- Artworks Table -->
    <a href="{{ route('blogs.create') }}" class="btn btn-primary mt-4"><i class="fas fa-plus"></i> Add Blogs</a>
    <table id="blogTable" class="table table-bordered table-hover">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th>Blog Id</th>
                <th>Title</th>
                <th>Content</th>
                <th>Picture</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->id }}</td>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->content }}</td>
                <td>
                @if ($blog->image->isNotEmpty())
                <img src="{{ asset('images/'. ($blog->image->first()->image_path)) }}" alt="{{ $blog->title }}" style="max-width: 300px; max-height: 300px;">
                 @else
                No Image
                @endif
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#showBlogModal{{ $blog->id }}"><i class="fas fa-eye"></i> Show</button>
                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-secondary me-2"><i class="fas fa-edit"></i> Edit</a>
                    @if ($blog->trashed())
                                        {{-- Restore button --}}
                                        <form method="POST" action="{{ route('blogs.restore', $blog->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success me-2">
                                                <i class="fas fa-trash-restore"></i> Restore Event
                                            </button>
                                        </form>
                                    @else
                                    <form method="POST" action="{{ route('blogs.destroy', $blog->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i> Delete
            </button>
        </form>
                                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    @foreach ($blogs as $blog)
            <!-- Show Event Modal -->
            <div class="modal fade" id="showBlogModal{{ $blog->id }}" tabindex="-1" aria-labelledby="showBlogModal{{ $blog->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showBlogModalLabel{{ $blog->id }}">{{ $blog->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Blog Title:</strong> {{ $blog->title }}</p>
                            <p><strong>Blog Content:</strong> {{ $blog->content }}</p>
                            <p><strong>Event Image:</strong></p>
                            <div class="text-center">
                            @if ($blog->image->isNotEmpty())
    <div style="display: flex;">
        @foreach ($blog->image as $image)
        <img src="{{ asset('images/'. ($blog->image->first()->image_path)) }}" style="max-width: 100px; max-height: 100px; margin-right: 10px;">
        @endforeach
    </div>
@else
    No Image
@endif

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- Add additional buttons if needed -->
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    <!-- Add Artwork Button -->
    <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addBlogModal"><i class="fas fa-plus"></i> Add Blog</button>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#blogTable').DataTable();
    });
</script>

<!-- Show Artwork Modal -->
<div class="modal fade" id="showBlogModal" tabindex="-1" aria-labelledby="showBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showBlogModalLabel">Artwork</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="https://via.placeholder.com/800x600" class="img-fluid rounded" alt="Blog">
            </div>
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
