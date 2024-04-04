@extends('layout.layout')

@section('content')
@include('layout.artHeader')
@include('layout.artNav')

<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-8">Edit User</h1>
    <div class="card shadow-lg rounded-lg">
        <div class="card-body p-8">
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Current Image</label>
                    <div class="w-40 h-40 overflow-hidden rounded-full mr-10">
                        <img src="{{ $user->image_path ? asset('storage/' . $user->image_path) : 'https://www.svgrepo.com/show/507442/user-circle.svg' }}" class="object-cover w-full h-full" alt="User Image">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Select New Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-6">
                        <label for="fname" class="block text-gray-700 font-bold mb-2">First Name</label>
                        <input type="text" class="form-control rounded-md border-gray-300 w-full py-2 px-4 focus:outline-none focus:border-blue-400" id="fname" name="fname" value="{{ $user->fname }}" required>
                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="lname" class="block text-gray-700 font-bold mb-2">Last Name</label>
                        <input type="text" class="form-control rounded-md border-gray-300 w-full py-2 px-4 focus:outline-none focus:border-blue-400" id="lname" name="lname" value="{{ $user->lname }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-6">
                        <label for="contact" class="block text-gray-700 font-bold mb-2">Contact</label>
                        <input type="text" class="form-control rounded-md border-gray-300 w-full py-2 px-4 focus:outline-none focus:border-blue-400" id="contact" name="contact" value="{{ $user->contact }}" required>
                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="text" class="form-control rounded-md border-gray-300 w-full py-2 px-4 focus:outline-none focus:border-blue-400" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-md-6 mb-6">
                        <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                        <input type="text" class="form-control rounded-md border-gray-300 w-full py-2 px-4 focus:outline-none focus:border-blue-400" id="status" name="status" value="{{ $user->status }}" required>
                    </div> -->
                    <div class="col-md-6 mb-6">
                        <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                        <input type="text" class="form-control rounded-md border-gray-300 w-full py-2 px-4 focus:outline-none focus:border-blue-400" id="password" name="password" >
                    </div>
                </div>

                <button type="submit" class="bg-gray-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
            </form>
            <form method="POST" action="{{ route('user.destroyforuser', $user->id) }}" onsubmit="return confirm('Are you sure you want to deactivate your account?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">Deactivate Account</button>
            </form>
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
