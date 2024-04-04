    @extends('layout.layout')

    @section('content')
    @include('layout.cusHeader')
        @include('layout.adminNav')

        <div class="container mx-auto mt-8">
            <!-- Artworks Table -->
            <a href="{{ route('event.create') }}" class="btn btn-primary mt-4"><i class="fas fa-plus"></i> Add Event</a>
            <div class="table-responsive">
                <table id="artworkTable" class="table table-bordered table-hover">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->date }}</td>
                                <td><span id="eventTimeFormatted{{ $event->id }}"></span></td>
                                <td>{{ $event->description }}</td>
                                <td>{{ $event->location }}</td>
                                <td>{{ $event->category }}</td>
                                <td>
                                    @if ($event->image->isNotEmpty())
                                    <img src="{{ asset('images/'. ($event->image->first()->image_path)) }}" alt="{{ $event->title }}" style="max-width: 300px; max-height: 300px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#showEventModal{{ $event->id }}"><i class="fas fa-eye"></i> Show</button>
                                    <a href="{{ route('event.edit', $event->id) }}" class="btn btn-sm btn-secondary me-2"><i class="fas fa-edit"></i> Edit</a>
                                    @if ($event->trashed())
                                        {{-- Restore button --}}
                                        <form method="POST" action="{{ route('event.restore', $event->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success me-2">
                                                <i class="fas fa-trash-restore"></i> Restore Event
                                            </button>
                                        </form>
                                    @else
                                    <form method="POST" action="{{ route('event.destroy', $event->id) }}">
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
            </div>
        </div>

        @foreach ($events as $event)
            <!-- Show Event Modal -->
            <div class="modal fade" id="showEventModal{{ $event->id }}" tabindex="-1" aria-labelledby="showEventModalLabel{{ $event->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showEventModalLabel{{ $event->id }}">{{ $event->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Event Date:</strong> {{ $event->date }}</p>
                            <p><strong>Event Time:</strong> <span id="eventTimeFormattedForModal{{ $event->id }}"></span></p>
                            <p><strong>Event Description:</strong> {{ $event->description }}</p>
                            <p><strong>Event Location:</strong> {{ $event->location }}</p>
                            <p><strong>Event Category:</strong> {{ $event->category }}</p>
                            <p><strong>Event Image:</strong></p>
                            <div class="text-center">
                              @if ($event->image->isNotEmpty())
    <div style="display: flex;">
        @foreach ($event->image as $image)
            <img src="{{ asset('images/'. $image->image_path) }}" alt="{{ $event->title }}" style="max-width: 100px; max-height: 100px; margin-right: 10px;">
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


<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Loop through each event to format time
            @foreach ($events as $event)
                var eventTime{{ $event->id }} = "{{ $event->time }}"; // Assuming $event->time contains the time value from the database

                // Split the time into hours and minutes
                var timeParts{{ $event->id }} = eventTime{{ $event->id }}.split(':');
                var hours{{ $event->id }} = parseInt(timeParts{{ $event->id }}[0], 10);
                var minutes{{ $event->id }} = timeParts{{ $event->id }}[1];

                // Determine AM or PM and convert hours to 12-hour format
                var period{{ $event->id }} = (hours{{ $event->id }} >= 12) ? 'PM' : 'AM';
                hours{{ $event->id }} = (hours{{ $event->id }} % 12 === 0) ? 12 : hours{{ $event->id }} % 12;

                // Format hours and minutes
                var formattedHours{{ $event->id }} = (hours{{ $event->id }} < 10 ? '0' : '') + hours{{ $event->id }};
                var formattedMinutes{{ $event->id }} = (minutes{{ $event->id }} < 10 ? '0' : '') + minutes{{ $event->id }};

                // Display the formatted time
                var formattedTime{{ $event->id }} = formattedHours{{ $event->id }} + ':' + formattedMinutes{{ $event->id }} + ' ' + period{{ $event->id }};
                document.getElementById('eventTimeFormatted{{ $event->id }}').textContent = formattedTime{{ $event->id }};
            @endforeach
        });

        </script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Loop through each event to format time
            @foreach ($events as $event)
                var eventTime{{ $event->id }} = "{{ $event->time }}"; // Assuming $event->time contains the time value from the database

                // Split the time into hours and minutes
                var timeParts{{ $event->id }} = eventTime{{ $event->id }}.split(':');
                var hours{{ $event->id }} = parseInt(timeParts{{ $event->id }}[0], 10);
                var minutes{{ $event->id }} = timeParts{{ $event->id }}[1];

                // Determine AM or PM and convert hours to 12-hour format
                var period{{ $event->id }} = (hours{{ $event->id }} >= 12) ? 'PM' : 'AM';
                hours{{ $event->id }} = (hours{{ $event->id }} % 12 === 0) ? 12 : hours{{ $event->id }} % 12;

                // Format hours and minutes
                var formattedHours{{ $event->id }} = (hours{{ $event->id }} < 10 ? '0' : '') + hours{{ $event->id }};
                var formattedMinutes{{ $event->id }} = (minutes{{ $event->id }} < 10 ? '0' : '') + minutes{{ $event->id }};

                // Display the formatted time
                var formattedTime{{ $event->id }} = formattedHours{{ $event->id }} + ':' + formattedMinutes{{ $event->id }} + ' ' + period{{ $event->id }};
                document.getElementById('eventTimeFormattedforshowmodal{{ $event->id }}').textContent = formattedTime{{ $event->id }};
            @endforeach
        });

        </script>


        <script>
            function showDeleteConfirmationModal(eventId) {
                var form = document.getElementById('deleteEventForm');
                form.action = "{{ url('events') }}/" + eventId;
                var modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
                modal.show();
            }
        </script>
    @endsection
