<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">


<!-- Main Content -->
<div class="container mx-auto mt-8">
    <!-- Events Table -->
    <table id="eventTable" class="table table-bordered table-hover">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sample Event Data -->
            <tr>
                <td>Event 1</td>
                <td>2024-04-15</td>
                <td>New York</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#showEventModal"><i class="fas fa-eye"></i> Show</button>
                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editEventModal"><i class="fas fa-edit"></i> Edit</button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteEventModal"><i class="fas fa-trash"></i> Delete</button>
                </td>
            </tr>
            <tr>
                <td>Event 2</td>
                <td>2024-05-10</td>
                <td>Los Angeles</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#showEventModal"><i class="fas fa-eye"></i> Show</button>
                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editEventModal"><i class="fas fa-edit"></i> Edit</button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteEventModal"><i class="fas fa-trash"></i> Delete</button>
                </td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>

    <!-- Add Event Button -->
    <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addEventModal"><i class="fas fa-plus"></i> Add Event</button>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#eventTable').DataTable();
    });
</script>

<!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Add Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add Event Form -->
                <form>
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="eventTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="eventDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventLocation" class="form-label">Location</label>
                        <input type="text" class="form-control" id="eventLocation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Show Event Modal -->
<div class="modal fade" id="showEventModal" tabindex="-1" aria-labelledby="showEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showEventModalLabel">Event Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Show Event Details Here -->
            </div>
        </div>
    </div>
</div>

<!-- Edit Event Modal -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Edit Event Form -->
            </div>
        </div>
    </div>
</div>

<!-- Delete Event Modal -->
<div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEventModalLabel">Delete Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this event?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
