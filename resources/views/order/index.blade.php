@extends('layout.layout')
@section('content')
@include('layout.adminNav')
<!-- Main Content -->
<div class="container mx-auto mt-8">
    <!-- orders Table -->
    <table id="orderTable" class="table table-bordered table-hover">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th>IDr</th>
                <th>Payment Status</th>
                <th>Shipping Address</th>
                <th>Status</th>
                <th>Actions</th> <!-- Added column for CRUD actions -->
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->payment_method}}</td>
                <td>{{ $order->shipping_address }}</td>
                <td>{{ $order->status }}</td>
\

                <td class="text-center">
                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="post">
                        @csrf
                        @if($order->status != 'Delivered')
                        <button type="submit" name="delivered" class="uppercase bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md">
                            Delivered
                        </button>

                        <button type="submit" name="cancelled" class="uppercase bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md">
                            Cancelled
                        </button>
                        @endif
                    </form>
                    <a href="#showorderModal" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#showorderModal"><i class="fas fa-edit"></i> View Reviews</a>



                    {{-- @if ($order->trashed()) --}}
                    {{-- Restore button --}}
                    {{-- <form method="POST" action="{{ route('order.restore', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="uppercase bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md">
                            Restore order
                        </button>
                    </form>
                @else --}}
                    {{-- Delete button --}}

                {{-- @endif --}}

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add order Button -->
    <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addorderModal"><i class="fas fa-plus"></i> Add order</button>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#orderTable').DataTable();
    });
</script>

<!-- Show order Modal -->
<div class="modal fade" id="showorderModal" tabindex="-1" aria-labelledby="showorderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showorderModalLabel">order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="https://via.placeholder.com/800x600" class="img-fluid rounded" alt="order">
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
