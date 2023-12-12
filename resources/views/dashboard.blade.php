<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/all.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



    </head>
    <style>
        .custominput {
            max-width: 1.9cm;

        }
    </style>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">

            {{-- SIDEBAR START --}}
            @include('layouts.sidebar')
            {{-- SIDEBAR END --}}



            <div class="main">
                @include('layouts.header')


                <main class="content" style="padding: 0.5rem 0.5rem 0.5rem;">
                    <div class="container-fluid p-0">




                        {{-- <form method="GET" action="{{ route('dashboard') }}">
                            <div class="row mt-2 mb-2">
                                <div class="col-4">
                                    <input style="margin-left: 10px;" type="text" class=" form-control " name="startyear" id="datepicker" />
                                </div>
                                <div class="col-4">
                                    <input style=""type="text" class="form-control" name="endyear" id="datepicker2" />
                                </div>
                                <div class="col-4">
                                    <button style="max-width:80px;" class="  form-control btn btn-primary" type="submit" value="">Filter</button>
                                </div>
                            </div>
                        </form> --}}







                        {{-- LINE SCHOOLS CHART SECTION --}}


                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Schools</h5>
                                        <h6 class="card-subtitle text-muted">
                                            <p>This chart displays the number of scholarships awarded each year for different programs.</p>
                                            <strong>

                                            </strong>
                                        </h6>
                                    </div>
                                    <div class="chart-contatiner" style="padding: 10px;">
                                        <canvas id="myLineChart" width="" height="200"></canvas>
                                    </div>

                                </div>

                            </div>

                            <div class="col-4">
                                <div>
                                    <label for="yearFilter">Select Year:</label>
                                    <select id="yearFilter" onchange="updateComparisonDiv()">
                                        <!-- Populate the select options with unique years from your data -->
                                        @foreach ($uniqueYears as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                    <button onclick="updateComparisonDiv()">Filter</button>
                                </div>
                                <div class="card">
                                    <div id="comparisonDiv">
                                        <h2>Percentage Comparison</h2>
                                        <p id="comparisonResults"></p>
                                    </div>

                                </div>
                            </div>
                        </div>












                    </div>

                </main>
            </div>
        </div>
    </body>
    {{-- CHART TOGGLING --}}
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        // Register the required plugins
        Chart.register([ChartDataLabels]);
        // Get the data from the PHP variable
        var ongoingPROGRAM = @json($ongoingPROGRAM);

        // Extract unique start years and scholarship programs for labels and datasets
        var startYears = [...new Set(ongoingPROGRAM.map(item => item.startyear))];
        var scholarshipPrograms = [...new Set(ongoingPROGRAM.map(item => item.scholarshipprogram))];

        // Create datasets for each scholarship program
        var datasets = scholarshipPrograms.map(program => {
            return {
                label: program,
                data: startYears.map(year => {
                    var match = ongoingPROGRAM.find(item => item.startyear === year && item.scholarshipprogram === program);
                    return match ? match.scholarshipprogramcount : 0;
                }),
                borderColor: getRandomColor(),
                borderWidth: 2,
                fill: false,
                backgroundColor: getRandomColor(), // Solid color for the area under the line
            };
        });

        // Create a line chart
        var ctx = document.getElementById('myLineChart').getContext('2d');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: startYears.map(String),
                datasets: datasets,
            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                        labels: startYears.map(String),
                    },
                    y: {
                        beginAtZero: true,
                    },
                },
                elements: {
                    line: {
                        tension: 0, // Make the lines straight
                    },
                },
                legend: {
                    display: true,
                    labels: {
                        boxWidth: 20, // Adjust the box width for each legend item
                        usePointStyle: true, // Use a square instead of a line for legend items
                    },
                },
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
            },
        });

        // Function to generate a random color (for demonstration purposes)
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        function updateComparisonDiv() {
            var comparisonResultsElement = document.getElementById('comparisonResults');
            comparisonResultsElement.innerHTML = '';

            // Convert the selected year to an integer
            var selectedYear = parseInt(document.getElementById('yearFilter').value);

            var filteredData = ongoingPROGRAM.filter(item => item.startyear === selectedYear);

            console.log('Filtered Data:', filteredData);

            var total = scholarshipPrograms.reduce((sum, program) => {
                var count = filteredData.reduce((programSum, item) => {
                    if (item.scholarshipprogram === program) {
                        return programSum + item.scholarshipprogramcount;
                    }
                    return programSum;
                }, 0);
                return sum + count;
            }, 0);

            comparisonResultsElement.innerHTML += `<strong>${selectedYear}:</strong><br>`;

            scholarshipPrograms.forEach(program => {
                var count = filteredData.reduce((programSum, item) => {
                    if (item.scholarshipprogram === program) {
                        return programSum + item.scholarshipprogramcount;
                    }
                    return programSum;
                }, 0);
                var percentage = total === 0 ? 0 : (count / total) * 100;
                comparisonResultsElement.innerHTML += ` ${program}: ${percentage.toFixed(2)}%,<br>`;
            });

            comparisonResultsElement.innerHTML += '<br>';
        }


        updateComparisonDiv();
    </script>


</html>
