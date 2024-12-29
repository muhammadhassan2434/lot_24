@extends('admin.layout.layout')
@section('panel')
    <div class="card my-2">
        <div class="card-header">
            <h5 class="card-title">Dashboard</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 p-2">

                    <div class="card bg-primary text-light p-4">
                        <h5>Total Users</h5>
                        <h6></h6>
                        <h6>{{$totalUsers }}</h6>
                    </div>
                </div>
                <div class="col-md-3 p-2">
                    <div class="card bg-primary text-light p-4">
                        <h5>Total Sellers</h5>
                        <h6></h6>
                        <h6>{{ $totalSellers }}</h6>
                    </div>
                </div>
                <div class="col-md-3 p-2">
                    <div class="card bg-primary text-light p-4">
                        <h5>Total Buyer</h5>
                        <h6></h6>
                        <h6>{{ $totalBuyer}}</h6>
                    </div>
                </div>
                <div class="col-md-3 p-2">
                    <div class="card bg-primary text-light p-4">
                        <h5>Total Brands</h5>
                        <h6></h6>
                        <h6>{{ $totalBrands }}</h6>
                    </div>
                </div>

            </div>
            </div>
        </div>
        <div class="card my-2">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 p-2" style="width:600px; height:400px;">
                        <canvas id="userSellerChart"></canvas>
                    </div>
                    <div class="col-md-6 p-2">
                        <canvas id="subscriptionChart"></canvas>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        {{-- <canvas id="subscriptionChart"></canvas> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('panel.js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Users, Sellers, and Buyers Pie Chart
    const userSellerCtx = document.getElementById('userSellerChart').getContext('2d');
    new Chart(userSellerCtx, {
        type: 'pie',
        data: {
            labels: ['Users', 'Sellers', 'Buyers'],
            datasets: [{
                data: [{{ $totalUsers }}, {{ $totalSellers }}, {{ $totalBuyer }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)', // Blue
                    'rgba(255, 99, 132, 0.7)', // Red
                    'rgba(75, 192, 192, 0.7)'  // Green
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });


    const months = @json($months); // Months data passed from PHP
    const premium = @json($premium); // Premium subscriptions data
    const standard = @json($standard); // Standard subscriptions data

    // Create the chart
    const ctx = document.getElementById('subscriptionChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months, // Use the months for the X-axis
            datasets: [
                {
                    label: 'Premium Subscriptions',
                    data: premium, // Data for premium subscriptions
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Standard Subscriptions',
                    data: standard, // Data for standard subscriptions
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1, // Increment by whole numbers
                        callback: function(value) {
                            return Number.isInteger(value) ? value : ''; // Display only whole numbers
                        }
                    }
                }
            }
        }
    });
    

</script>
@endsection
