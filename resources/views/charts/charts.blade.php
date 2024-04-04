<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User and Artist Roles Chart</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="max-w-xl w-full bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-xl font-semibold mb-4">User and Artist Roles</h1>
        <canvas id="roleChart" width="400" height="400"></canvas>
    </div>

    <script>
        var userCount = {{ $userCount }};
        var artistCount = {{ $artistCount }};

        var ctx = document.getElementById('roleChart').getContext('2d');

        var roleChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['User', 'Artist'],
                datasets: [{
                    label: 'User and Artist Roles',
                    data: [userCount, artistCount],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)', // Blue for User
                        'rgba(255, 99, 132, 0.2)'  // Red for Artist
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
