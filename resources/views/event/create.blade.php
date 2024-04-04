@extends('layout.layout')

@section('content')
@include('layout.adminNav')
<form method="POST" action="{{ route('event.store') }}" enctype="multipart/form-data">
        @csrf
<div class="container py-6 space-y-5 bg-white">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <!-- Event Title -->
        <div class="p-6 bg-white hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Event Title</div>
            <div class="mx-5 my-10">
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="eventTitle">Title:</label>
                    <input type="text" id="eventTitle" name="event_title" placeholder="Enter event title" class="w-full px-3 py-2 border rounded-md">
                </div>
            </div>
        </div>

        <!-- Event Date -->
        <div class="p-6 bg-white hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Event Date</div>
            <div class="mx-5 my-10">
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="eventDate">Date:</label>
                    <input type="date" id="eventDate" name="event_date" class="w-full px-3 py-2 border rounded-md">
                </div>
            </div>
        </div>

        <!-- Event Time -->
        <div class="p-6 bg-white hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Event Time</div>
            <div class="mx-5 my-10">
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="eventTime">Time:</label>
                    <input type="time" id="eventTime" name="event_time" class="w-full px-3 py-2 border rounded-md">
                </div>
            </div>
        </div>

        <!-- Event Description -->
        <div class="p-6 bg-white hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Event Description</div>
            <div class="mx-5 my-10">
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="eventDescription">Description:</label>
                    <textarea id="eventDescription" name="event_description" placeholder="Enter event description" rows="4" class="w-full px-3 py-2 border rounded-md"></textarea>
                </div>
            </div>
        </div>

        <!-- Event Location -->
        <div class="p-6 bg-white hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Event Location</div>
            <div class="mx-5 my-10">
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="eventLocation">Location:</label>
                    <input type="text" id="eventLocation" name="event_location" placeholder="Enter event location" class="w-full px-3 py-2 border rounded-md">
                </div>
            </div>
        </div>
        <!-- Event Category -->
        <div class="p-6 bg-white hover:shadow-2xl rounded-2xl transition mx-5">
            <div class="text-lg font-bold mb-4 border-b">Event Category</div>
            <div class="mx-5 my-10">
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="eventCategory">Category:</label>
                    <select id="eventCategory" name="event_category" class="w-full px-3 py-2 border rounded-md">
                        <option value="">Select category</option>
                        <option value="Art Exhibition">Art Exhibition</option>
                        <option value="Workshop">Workshop</option>
                        <option value="Performance">Performance</option>
                        <option value="Conference">Conference</option>
                    </select>
                </div>
            </div>
        </div>

      <!-- Event Image Upload -->
<div class="flex items-center justify-center mt-10 text-center">
    <label for="fileInput" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
        <input type="file" accept=".png, .jpg" id="fileInput" name="images[]" style="display: none;" multiple accept="image/*">
        <i class="bg-transparent text-gray-500 hover:text-red-500 font-bold h-24 w-full py-2 px-4 rounded-xl flex justify-center items-center">
            <i class="fa-solid fa-image mr-2"></i>
            Select Images
        </i>
    </label>
</div>


        <div class="text-lg font-bold mb-5 my-10 mx-20 border-b">Selected Photos:</div>

        <div id="imageContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Images will be dynamically inserted here -->
        </div>

    <!-- Submit Button -->
    <div class="mx-auto w-64">
        <button id="createEventBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full">Create Event</button>
    </div>
</div>
</form>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


@endsection
@section('scripts')
@parent
<script>
    // Function to handle file input change event
    document.getElementById('fileInput').addEventListener('change', function(e) {
        var files = e.target.files; // Get the selected files
        var imageContainer = document.getElementById('imageContainer'); // Get the image container

        // Clear previous contents of the container
        imageContainer.innerHTML = '';

        // Loop through each selected file
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader(); // Create a FileReader object

            // Closure to capture the file information
            reader.onload = (function(file) {
                return function(e) {
                    // Create an image element
                    var imgElement = document.createElement('img');
                    imgElement.classList.add('w-full', 'h-auto');
                    imgElement.src = e.target.result; // Set the image source to the FileReader result
                    // Append the image element to the container
                    imageContainer.appendChild(imgElement);
                };
            })(file);

            // Read the selected file as a Data URL
            reader.readAsDataURL(file);
        }
    });
</script>

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

