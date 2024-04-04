@extends('layout.layout')

@section('content')
<form method="POST" action="{{ route('cusregister.store') }}" enctype="multipart/form-data">
{{-- register --}}
<div class="py-10 bg-cover bg-center bg-no-repeat" style="background-image: url('/storage/background/bg2.jpg')">

    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-2xl px-6 py-7 overflow-hidden">
        <div class="ml-10 mt-5">
            <h2 class="text-2xl uppercase font-medium mb-1">Customer Signup</h2>
            <p class="text-gray-900 mb-6 text-sm">
                Register to
                <span class="font-semibold text-lg text-center text-red-800 mb-2">Spolarium</span>
            </p>
        </div>

            <div class="space-y-4">

                {{-- dinivide ko sa dalwa --}}
                <div class="flex">
                    <div class="w-1/2 p-4">
                        <div class="max-w-lg mx-auto bg-white border-r px-6 overflow-hidden">
                            {{-- left part --}}
                            <div>
                                <div class="flex">
                                    <label class="text-gray-900 mb-2 block">First Name </label>
                                    <p class="text-primary">*</p>
                                </div>
                                <input type="text" name="fname" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="First Name">
                            </div>
                            <div>
                                <div class="flex">
                                    <label class="text-gray-900 mb-2 block">Last Name </label>
                                    <p class="text-primary">*</p>
                                </div>
                                <input type="text" name="lname"class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Last Name">
                            </div>
                            <div>
                                <div class="flex">
                                    <label class="text-gray-900 mb-2 block">Email Address</label>
                                    <p class="text-primary">*</p>
                                </div>
                                <input type="email" name="email" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Email Address">
                            </div>
                            <div>
                                <div class="flex">
                                    <label class="text-gray-900 mb-2 block">Contact Number</label>
                                    <p class="text-primary">*</p>
                                </div>
                                <input type="text" name="contact" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Contact">
                            </div>
                            <div>
                                <div class="flex">
                                    <label class="text-gray-900 mb-2 block">Password</label>
                                    <p class="text-primary">*</p>
                                </div>
                                <input type="password" name="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Password">
                            </div>
                            <div>
                                <div class="flex">
                                    <label class="text-gray-900 mb-2 block">Confirm Password</label>
                                    <p class="text-primary">*</p>
                                </div>
                                <input type="password" name="password_confirmation"class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 p-4">
                        <div class="max-w-lg mx-auto border-l bg-white px-6 overflow-hidden">
                            {{-- right part --}}
                            {{-- <div>
                                <div class="flex">
                                    <label class="text-gray-500 mb-2 block">Facebook Link</label>
                                    <p class="text-primary">*</p>
                                </div>
                                <input type="text" name="facebook_link" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Facebook Link">
                            </div> --}}

                                <!-- Add file uploads section -->
                                <div class="mt-2">
                                    <label class="block text-gray-900 mb-2">Upload Profile Picture</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-red-800">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Allowed file types:  PNG, JPG (MAX. 800x400px)</p>
                                            </div>
                                            <input id="dropzone-file" type="file" name="image_path" class="hidden" accept=" .png, .jpg, .jpeg" />
                                        </label>
                                    </div>
                                </div>


                        <p class="text-gray-900 mt-1 ml-3 text-xs font-extralight text-gray-200">
                            Upload your preffered profile picture.
                        </p>

                        </div>
                    </div>
                </div>

        </div>

            @csrf
        <div class="flex justify-center items-center mt-5">
            <button type="submit" class="block w-96 py-2 text-center text-white bg-gray-700 rounded-md hover:bg-red-800 hover:text-white transition uppercase font-roboto font-medium">
                Sign up
            </button>
        </div>
    </form>

        <p class="mt-4 text-gray-500 text-center">
            Already got an Account?
            <a href="login" class="text-primary text-semibold">Login Now</a>
        </p>

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

