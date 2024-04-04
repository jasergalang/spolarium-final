@extends('layout.layout')
@section('content')
@include('layout.artHeader')
@include('layout.artNav')
<!-- Main Content -->
<div class="container mx-auto mt-8">
    <!-- Artworks Table -->
    <table id="artworkTable" class="table table-bordered table-hover">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th>Name of Artwork</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Dimensions</th>
                <th>Image</th>
                <th>Actions</th> <!-- Added column for CRUD actions -->
            </tr>
        </thead>
        <tbody>
            @foreach($artworks as $artwork)
            <tr>
                <td>{{ $artwork->name }}</td>
                <td>{{ $artwork->price }}</td>
                <td>{{ $artwork->desc }}</td>
                <td>{{ $artwork->category }}</td>
                <td>{{ $artwork->size }}</td>
                <td>
                    @if ($artwork->image->isNotEmpty())
                        <img src="{{ asset('images/' . $artwork->image->first()->image_path) }}" alt="{{ $artwork->name }}" style="max-width: 300px; max-height: 300px;">
                    @else
                        No Image
                    @endif
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#showArtworkModal{{ $artwork->id }}"><i class="fas fa-eye"></i> Show</button>
                    <a href="{{ route('artwork.edit', $artwork->id) }}" class="btn btn-sm btn-primary me-2"><i class="fas fa-edit"></i> Edit</a>
                    @if ($artwork->trashed())
                    {{-- Restore button --}}
                    <form method="POST" action="{{ route('artwork.restore', $artwork->id) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="uppercase bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md">
                            Restore Artwork
                        </button>
                    </form>
                @else
                    {{-- Delete button --}}
                    <form method="POST" action="{{ route('artwork.destroy', $artwork->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="uppercase bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md">
                            Delete Artwork
                        </button>
                    </form>
                @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add Artwork Button -->
    <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addArtworkModal"><i class="fas fa-plus"></i> Add Artwork</button>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#artworkTable').DataTable();
    });
</script>

<!-- Show Artwork Modal -->
<div class="modal fade" id="showArtworkModal" tabindex="-1" aria-labelledby="showArtworkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showArtworkModalLabel">Artwork</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="https://via.placeholder.com/800x600" class="img-fluid rounded" alt="Artwork">
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
