@extends('layout.layout')
@section('content')
@include('layout.artHeader')
@include('layout.artNav')
<!-- Main Content -->
<div class="container mx-auto mt-8">
    <!-- Artworks Table -->
    <table id="artworkTable" class="table table-bordered table-hover">
    <a href="{{ route('artwork.create') }}" class="btn btn-primary mt-4"><i class="fas fa-plus"></i> Add Artwork</a>
        <thead class="bg-gray-800 text-white">
            <tr>
                <th>Name of Artwork</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Dimensions</th>
                <th>Image</th>
                <th>Actions</th>
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


<!-- Modal -->
@foreach ($artworks as $artwork)
    <!-- Show Event Modal -->
    <div class="modal fade" id="showArtworkModal{{ $artwork->id }}" tabindex="-1" aria-labelledby="showArtworkModalLabel{{ $artwork->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showArtworkModalLabel{{ $artwork->id }}">{{ $artwork->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Artwork Name:</strong> {{ $artwork->name }}</p>
                    <p><strong>Artwork Price:</strong> {{ $artwork->price }}</p>
                    <p><strong>Artwork Description:</strong> {{ $artwork->desc }}</p>
                    <p><strong>Artwork Category:</strong> {{ $artwork->category }}</p>
                    <p><strong>Artwork Dimensions:</strong> {{ $artwork->dimension }}</p>
                    <p><strong>Artwork Image:</strong></p>
                    <div class="text-center">
                      @if ($artwork->image->isNotEmpty())
<div style="display: flex;">
@foreach ($artwork->image as $image)
    <img src="{{ asset('images/' . $artwork->image->first()->image_path) }}" alt="{{ $artwork->title }}" style="max-width: 100px; max-height: 100px; margin-right: 10px;">
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
<!-- Show Artwork Modal -->



        <!-- Modal -->
        @foreach ($artworks as $artwork)
            <!-- Show Event Modal -->
            <div class="modal fade" id="showArtworkModal{{ $artwork->id }}" tabindex="-1" aria-labelledby="showArtworkModalLabel{{ $artwork->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showArtworkModalLabel{{ $artwork->id }}">{{ $artwork->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Artwork Name:</strong> {{ $artwork->name }}</p>
                            <p><strong>Artwork Price:</strong> {{ $artwork->price }}</p>
                            <p><strong>Artwork Description:</strong> {{ $artwork->desc }}</p>
                            <p><strong>Artwork Category:</strong> {{ $artwork->category }}</p>
                            <p><strong>Artwork Dimensions:</strong> {{ $artwork->dimension }}</p>
                            <p><strong>Artwork Image:</strong></p>
                            <div class="text-center">
                              @if ($artwork->image->isNotEmpty())
    <div style="display: flex;">
        @foreach ($artwork->image as $image)
            <img src="{{ asset('images/' . $artwork->image->first()->image_path) }}" alt="{{ $artwork->title }}" style="max-width: 100px; max-height: 100px; margin-right: 10px;">
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
