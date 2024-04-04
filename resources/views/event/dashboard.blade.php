@include('layout.layout')
@include('layout.cusHeader')
@include('layout.cusNav')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Upcoming Events</h1>
        @foreach($events as $event)
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="flex">
                <div class="w-1/3">
                    <img src="{{ asset('images/'. ($event->image->first()->image_path)) }}" alt="{{ $event->title }}" class="w-full h-64 object-cover">
                </div>
                <div class="w-2/3 p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Title: {{ $event->title }}</h2>
                    <p class="text-gray-700 text-lg leading-relaxed mb-4">Description: {{ $event->description }}</p>
                    <p class="text-gray-700 text-lg font-semibold">Location: {{ $event->location }}</p>
                            <p class="text-gray-700 text-lg leading-relaxed mb-2">Date: {{ $event->date }}</p>
                            <p class="text-gray-700 text-lg leading-relaxed">Time: <span id="eventTimeFormatted{{ $event->id }}" class="font-semibold"></span></p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($events as $event)
            var eventTime{{ $event->id }} = "{{ $event->time }}"; // Assuming $event->time contains the time value from the database

            var timeParts{{ $event->id }} = eventTime{{ $event->id }}.split(':');
            var hours{{ $event->id }} = parseInt(timeParts{{ $event->id }}[0], 10);
            var minutes{{ $event->id }} = timeParts{{ $event->id }}[1];
            var period{{ $event->id }} = (hours{{ $event->id }} >= 12) ? 'PM' : 'AM';
            hours{{ $event->id }} = (hours{{ $event->id }} % 12 === 0) ? 12 : hours{{ $event->id }} % 12;
            var formattedHours{{ $event->id }} = (hours{{ $event->id }} < 10 ? '0' : '') + hours{{ $event->id }};
            var formattedMinutes{{ $event->id }} = (minutes{{ $event->id }} < 10 ? '0' : '') + minutes{{ $event->id }};
            var formattedTime{{ $event->id }} = formattedHours{{ $event->id }} + ':' + formattedMinutes{{ $event->id }} + ' ' + period{{ $event->id }};
            document.getElementById('eventTimeFormatted{{ $event->id }}').textContent = formattedTime{{ $event->id }};
            @endforeach
        });
    </script>
</body>
</html>
