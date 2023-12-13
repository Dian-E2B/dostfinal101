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
                            <div class="col-12">
                                <div class="card">

                                    <div class="row">


                                        <div class="col-10">
                                            <h5 class="card-title">Schools</h5>
                                            <p>This chart displays the number of scholarships awarded each year for different programs.</p>
                                            <div class="" style="">
                                                <canvas id="myProgramChart" width="" height="100"></canvas>
                                            </div>
                                        </div>

                                        <div class="col-2">



                                            <div id="comparisonDiv">
                                                <label style="font-size: 9pt" for="yearFilter">Select Year:</label>
                                                <select class="form-control" style="max-width: 1.7cm" id="yearFilter" onchange="updateComparisonDiv()">
                                                    <!-- Populate the select options with unique years from your data -->
                                                    @foreach ($uniqueYears as $year)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="mt-3" id="comparisonResults"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <button id="resetZoomButton">Reset Zoom</button>
                                </div>

                            </div>

                            <div class="col-4">

                            </div>
                        </div>












                    </div>

                </main>
            </div>
        </div>
    </body>
    {{-- CHART TOGGLING --}}
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/0.7.7/chartjs-plugin-zoom.js" integrity="sha512-qeclqxc+2KW7GtbmHcj/Ev5eBoYpPnuAcPqusYRIfvaC9OWHlDwu1BrIVPYvfNDG+SRIRiPIokiSvhlLJXDqsw==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script>
        // Register the required plugins


        // Get the data from the PHP variable
        var ongoingPROGRAM = @json($ongoingPROGRAM);

        // Extract unique start years and scholarship programs for labels and datasets
        var startYears = [...new Set(ongoingPROGRAM.map(item => item.startyear))];
        var scholarshipPrograms = [...new Set(ongoingPROGRAM.map(item => item.scholarshipprogram))];

        // Create datasets for each scholarship program
        var datasets = scholarshipPrograms.map(function(program, index) {
            return {
                label: program,
                data: startYears.map(year => {
                    var match = ongoingPROGRAM.find(item => item.startyear === year && item.scholarshipprogram === program);
                    return match ? match.scholarshipprogramcount : 0;
                }),
                borderColor: getPredefinedColor(index),
                borderWidth: 2,
                fill: false,
                backgroundColor: getPredefinedColor(index), // Solid color for the area under the line
            };
        });

        // Create a line chart
        var myProgramChart = document.getElementById('myProgramChart').getContext('2d');
        var myProgramChart = new Chart(myProgramChart, {
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
                    zoom: {
                        pan: {
                            enabled: true,
                            mode: 'xy',
                        },
                        zoom: {
                            enabled: true,
                            mode: 'xy',
                        },
                    },
                },
            },
        });

        document.getElementById('resetZoomButton').addEventListener('click', function() {
            myProgramChart.resetZoom();
        });

        function getPredefinedColor(index) {
            var predefinedColors = ['#3498db', '#000000', '#49C4D3'];
            return predefinedColors[index % predefinedColors.length];
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

            // comparisonResultsElement.innerHTML += `<strong>${selectedYear}:</strong><br>`;

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
