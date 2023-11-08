<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">

        {{-- SIDEBAR START --}}
        @include('layouts.sidebar')
        {{-- SIDEBAR END --}}



        <div class="main">
            @include('layouts.header')

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="">

                        {{-- LINE SCHOOLS CHART SECTION --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Scholar Applications by School</h5>
                                        <h6 class="card-subtitle text-muted">
                                            {{-- DESCRIPTIVE COMPARISON --}}
                                            <strong>
                                                The school with the highest number of scholar applications is
                                                <span style="color: blue">{{ $mostcommonschool->school }}</span>, while
                                                @if (count($leastCommonSchools) > 0)
                                                    <span
                                                        style="color: blue">{{ implode(', ', $leastCommonSchools->pluck('school')->toArray()) }}</span>
                                                @else
                                                @endif
                                                has the fewest applications.
                                            </strong>
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-contatiner">
                                            <canvas id="myChart" width="" height="500"></canvas>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- GENDER CHART SECTION --}}
                        <div class="col-12 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Gender Distribution of Scholar Applications</h5>

                                    <h6 class="card-subtitle text-muted"> <strong>
                                            {{-- DESCRIPTIVE COMPARISON --}}
                                            The majority of scholar applications come from
                                            @if ($mosthighestgender->MF == 'M')
                                                <span style="color: blue">Male</span>
                                            @else
                                                <span style="color: pink">Female</span>
                                            @endif
                                            students, with @if ($mostlowestgender->MF == 'F')
                                                <span style="color: pink">Female</span>
                                            @else
                                                <span style="color: blue">Male</span>
                                            @endif
                                            students making up the smaller portion.
                                        </strong></h6>

                                </div>
                                <div class="card-body">
                                    <div class="chart chart-sm">
                                        <canvas id="genderPieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-lg-12 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Doughnut Chart</h5>
                                    <h6 class="card-subtitle text-muted">Doughnut charts are excellent at showing the
                                        relational proportions between data.</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart chart-g">
                                        <canvas id="chartjs-doughnut"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div> --}}



                        {{-- <div class="col-12 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Radar Chart</h5>
                                    <h6 class="card-subtitle text-muted">A radar chart is a way of showing multiple data
                                        points and the variation between them.
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="chartjs-radar"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
--}}

                        {{--    <div class="col-12 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Polar Area Chart</h5>
                                    <h6 class="card-subtitle text-muted">Polar area charts are similar to pie charts,
                                        but each segment has the same angle.</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="chartjs-polar-area"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                    </div>

            </main>
        </div>
    </div>
</body>
{{-- CHART TOGGLING --}}


<script>
    var ctx = document.getElementById('myChart').getContext('2d');

    // Extract the aggregated data from the PHP array
    var schoolCounts = @json($schoolCounts);
    var labels = Object.keys(schoolCounts);
    var data = Object.values(schoolCounts);

    console.log(@json($schoolCounts));

    // Generate an array of random colors
    var backgroundColors = labels.map(function() {
        return 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math
            .floor(Math.random() * 256) + ', 0.2)';
    });

    var borderColor = 'rgba(75, 192, 192, 1)'; // Set a common border color

    var maxIndex = data.indexOf(Math.max(...data)); // Find the index of the largest value

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '',
                data: data,
                backgroundColor: backgroundColors, // Different colors for each bar
                borderColor: borderColor,
                borderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            tooltips: {
                callbacks: {
                    label: function(context) {
                        if (context.dataIndex === maxIndex) {
                            // Customize the label for the largest data point
                            return 'Largest Value: ' + context.parsed.y;
                        } else {
                            return context.dataset.label + ': ' + context.parsed.y;
                        }
                    },
                }
            }
        }
    });

    var ctx = document.getElementById('genderPieChart').getContext('2d');

    var genderData = @json($genderData);


    var chart = new Chart(ctx, {
        type: 'pie',

        data: {

            datasets: [{
                data: genderData.map(item => item.count),
                backgroundColor: ['pink', 'blue'], // Define colors for each gender
            }],
            labels: [
                'Female', 'Male'
            ],
        },
        options: {
            responsive: true,
        },
    });
</script>

</html>
