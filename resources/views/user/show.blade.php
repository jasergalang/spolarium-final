@extends('layout.layout')

@section('content')

@include('layout.artHeader')
@include('layout.artNav')

{{-- account wrapper --}}
<div class="container p-6 bg-white">
    <div class="container pt-4 pb-4 mx-5">
        <div class="flex items-center">
            <!-- User Image -->
            <div class="w-32 h-32  overflow-hidden rounded-full mr-10">
                <img src="{{ $user->image_path ? asset('storage/' . $user->image_path) : 'https://www.svgrepo.com/show/507442/user-circle.svg' }}" class="object-cover w-full h-full" alt="User Image">
            </div>
            <!-- User Information -->
            <div>
                <h3 class="text-2xl font-semibold">{{ $user->fname }} {{ $user->lname }}</h3>
                <p class="text-gray-500">{{ $user->email }}</p>

            </div>
            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Edit Profile
</a>


        </div>
        </div>
    </div>

    <div class="container gap-6 border-t pt-4 pb-16 items-start">
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-md font-semibold mb-4">Personal Information</h2>
            <div class="bg-white p-4 rounded-md shadow-md">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Name</h3>
                        <p>{{ $user->fname }} {{ $user->lname }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Email</h3>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Phone</h3>
                        <p>{{ $user->contact }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Status</h3>
                        <p>{{ $user->status }}</p>
                    </div>
                </div>
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
