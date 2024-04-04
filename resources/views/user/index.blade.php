@extends('layout.layout')
@section('content')
{{-- @include('layout.artHeader')
@include('layout.artNav') --}}
<!-- Main Content -->
<div class="container mx-auto mt-8">
    <!-- users Table -->
    <table id="userTable" class="table table-bordered table-hover">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Role</th>
                <th>Status</th>
                <th>Image</th>
                <th>Actions</th> <!-- Added column for CRUD actions -->
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->fname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->contact }}</td>
                <td>{{ $user->roles }}</td>
                <td>{{ $user->status }}</td>
                <td>
                    @if ($user->image_path)
                        <img src="{{ asset('/storage/' . $user->image_path) }}" alt="{{ $user->name }}" style="max-width: 300px; max-height: 300px;">
                    @else
                        No Image
                    @endif
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#showuserModal{{ $user->id }}"><i class="fas fa-eye"></i> Show</button>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary me-2"><i class="fas fa-edit"></i> Edit</a>
                    @if ($user->trashed())
                    {{-- Restore button --}}
                    <form method="POST" action="{{ route('user.restore', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="uppercase bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md">
                            Restore user
                        </button>
                    </form>
                @else
                    {{-- Delete button --}}
                    <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="uppercase bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md">
                            Delete user
                        </button>
                    </form>
                @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add user Button -->
    <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#adduserModal"><i class="fas fa-plus"></i> Add user</button>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    });
</script>

<!-- Show user Modal -->
<div class="modal fade" id="showuserModal" tabindex="-1" aria-labelledby="showuserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showuserModalLabel">user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="https://via.placeholder.com/800x600" class="img-fluid rounded" alt="user">
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
