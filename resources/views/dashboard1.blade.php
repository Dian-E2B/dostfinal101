<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/all.css') }}">



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
                                            <h5 class="card-title">Schools</h5>
                                            <h6 class="card-subtitle text-muted">
                                                {{-- DESCRIPTIVE COMPARISON --}}
                                                <strong>
                                                    The school with the highest number of scholar applications is
                                                    <span style="color: blue">{{ $mostcommonschool->school }}</span>, while
                                                    @if (count($leastCommonSchools) > 0)
                                                        <span style="color: blue">{{ implode(', ', $leastCommonSchools->pluck('school')->toArray()) }}</span>
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
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $(function() {
            $('#datetimepicker').datetimepicker();
        });
        // Register the required plugins
        Chart.register([ChartDataLabels]);

        var ctx = document.getElementById('myChart').getContext('2d');

        // Extract the aggregated data from the PHP array
        var schoolCounts = @json($schoolCounts);
        var labels = Object.keys(schoolCounts);
        var data = Object.values(schoolCounts);

        // Set a solid blue color for all bars
        var backgroundColor = '#9FC5E8';
        var borderColor = 'rgba(54, 162, 235, 1)';

        var minValue = Math.min(...data);
        var minIndices = data.reduce((indices, value, index) => {
            if (value === minValue) {
                indices.push(index);
            }
            return indices;
        }, []);

        var maxValue = Math.max(...data);
        var maxIndex = data.indexOf(maxValue);

        // Set background color dynamically for each bar
        var dynamicBackgroundColors = data.map((value, index) => {
            if (index === maxIndex) {
                return '#B6D7A8'; // Set color to green for the highest value
            } else if (minIndices.includes(index)) {
                return '#F4CCCC'; // Set color to red for the lowest value
            } else {
                return backgroundColor; // Default color
            }
        });

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '',
                    data: data,
                    backgroundColor: dynamicBackgroundColors,
                    borderColor: borderColor,

                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        anchor: 'center', // Set to 'center' to center the label horizontally
                        align: 'center', // Set to 'center' to center the label vertically
                        color: 'black', // Set the default color to black
                        textAlign: 'center',
                        font: {
                            style: 'italic',
                            weight: 'bold'
                            // Set to 'bold' to make the label bold
                        },
                        formatter: (value, context) => {
                            const dataIndex = context.dataIndex;
                            const datapoints = context.dataset.data;
                            const total = datapoints.reduce((total, datapoint) => total + datapoint, 0);
                            const percentage = (value / total) * 100;

                            let label = percentage.toFixed(1) + '%';

                            if (dataIndex === maxIndex) {

                                return 'High:\n' + label;
                            } else if (minIndices.includes(dataIndex)) {

                                return 'Low:\n' + label;
                            } else {
                                return label;
                            }
                        },
                    }
                }
            }
        });
    </script>

</html>
