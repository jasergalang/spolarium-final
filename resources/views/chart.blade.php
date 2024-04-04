@extends('layout.layout')
@section('content')
@include('layout.adminHeader')
@include('layout.adminNav')

<div style="display: flex; justify-content: space-between; align-items: center;">
    <div style="flex-grow: 1;">
        <!-- Line Graph for Materials -->
        <canvas id="materialLineChart" width="400" height="400"></canvas>
    </div>

    <div style="flex-grow: 1;">
        <!-- Pie Chart for Customer vs Artist Comparison -->
        <canvas id="customerArtistPieChart" width="400" height="400"></canvas>
    </div>

    <div style="flex-grow: 1;">
        <!-- Bar Chart for Artwork -->
        <canvas id="artworkBarChart" width="400" height="400"></canvas>
    </div>
</div>

<script>
    // Fetch data from the server
    var materialData = {!! json_encode($materialData) !!};
    var customerData = {!! json_encode($customerData) !!};
    var artistData = {!! json_encode($artistData) !!};
    var artworkData = {!! json_encode($artworkData) !!};

    // Calculate total customers
    var totalCustomers = customerData.data.reduce((acc, curr) => acc + curr, 0);

    // Initialize Line Chart for Materials
    var materialLineCtx = document.getElementById('materialLineChart').getContext('2d');
    var materialLineChart = new Chart(materialLineCtx, {
        type: 'line',
        data: {
            labels: materialData.labels,
            datasets: [{
                label: 'Material Stock',
                data: materialData.data,
                borderColor: 'red',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Stock'
                    }
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Material Name'
                    }
                }]
            }
        }
    });

    // Calculate total artists
    var totalArtists = artistData.data.reduce((acc, curr) => acc + curr, 0);

    // Initialize Pie Chart for Customer vs Artist Comparison
    var customerArtistPieCtx = document.getElementById('customerArtistPieChart').getContext('2d');
    var customerArtistPieChart = new Chart(customerArtistPieCtx, {
        type: 'pie',
        data: {
            labels: ['Customers', 'Artists'],
            datasets: [{
                data: [totalCustomers, totalArtists],
                backgroundColor: ['blue', 'green']
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: 'right'
            }
        }
    });

    // Initialize Bar Chart for Artwork
    var artworkBarCtx = document.getElementById('artworkBarChart').getContext('2d');
    var artworkBarChart = new Chart(artworkBarCtx, {
        type: 'bar',
        data: {
            labels: artworkData.labels,
            datasets: [{
                label: 'Availability',
                data: artworkData.data,
                backgroundColor: 'green',
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        precision: 0
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Availability'
                    }
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Artwork Name'
                    }
                }]
            }
        }
    });
</script>
@endsection
