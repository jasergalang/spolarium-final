@extends('layout.layout')
@section('content')
@include('layout.adminNav')
<!-- Main Content -->
<div class="container mx-auto mt-8">
    <!-- Artworks Table -->
    <a href="{{ route('material.create') }}" class="btn btn-primary mt-4"><i class="fas fa-plus"></i> Add Material</a>
    <table id="artworkTable" class="table table-bordered table-hover">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th>Name of Material</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th> <!-- Added column for CRUD actions -->
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
            <tr>
                <td>{{ $material->name }}</td>
                <td>{{ $material->price }}</td>
                <td>{{ $material->desc }}</td>
                <td>{{ $material->category }}</td>
                <td>{{ $material->stock }}</td>
                   <td>
                        @if ($material->image->isNotEmpty())
                            <img src="{{ asset('images/' . $material->image->first()->image_path) }}" alt="{{ $material->name }}" style="max-width: 300px; max-height: 300px;">
                        @else
                            No Image
                        @endif
                    </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#showArtworkModal{{ $material->id }}"><i class="fas fa-eye"></i> Show</button>
                    <a href="{{ route('material.edit', $material->id) }}" class="btn btn-sm btn-primary me-2"><i class="fas fa-edit"></i> Edit</a>
                    @if ($material->trashed())
                    {{-- Restore button --}}
                    <form method="POST" action="{{ route('material.restore', $material->id) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-success me-2">
                                                <i class="fas fa-trash-restore"></i> Restore
                                            </button>
                    </form>
                @else
                    {{-- Delete button --}}
                    <form method="POST" action="{{ route('material.destroy', $material->id) }}">
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

   @foreach ($materials as $material)
            <!-- Show Event Modal -->
            <div class="modal fade" id="showArtworkModal{{ $material->id }}" tabindex="-1" aria-labelledby="showArtworkModalLabel{{ $material->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showEventModalLabel{{ $material->id }}">{{ $material->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Material Name:</strong> {{ $material->name }}</p>
                            <p><strong>Material Price:</strong> {{ $material->price }}</p>
                            <p><strong>Material Description:</strong>{{ $material->description }}</p>
                            <p><strong>Material Category:</strong> {{ $material->category }}</p>
                            <p><strong>Material Stock:</strong> {{ $material->stock }}</p>
                            <p><strong>Material Image:</strong></p>
                            <div class="text-center">
                              @if ($material->image->isNotEmpty())
    <div style="display: flex;">
        @foreach ($material->image as $image)
            <img src="{{ asset('images/' . $material->image->first()->image_path) }}" alt="{{ $material-> name}}" style="max-width: 100px; max-height: 100px; margin-right: 10px;">
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
