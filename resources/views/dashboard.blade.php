<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/all.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">


        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">

            {{-- SIDEBAR START --}}
            @include('layouts.sidebar')
            {{-- SIDEBAR END --}}



            <div class="main">
                @include('layouts.header')

                <main class="content" style="padding: 1rem 1rem 1.5rem;">
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

                                                </strong>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-contatiner">
                                                <canvas id="SCHOOLSCHART" width="" height="500"></canvas>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                {{-- DAVAOCIT SCHOOLS CHART SECTION --}}

                                {{-- <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">DAVAO CITY RA7687</h5>
                                            <h6 class="card-subtitle text-muted">

                                                <strong>

                                                </strong>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-contatiner">
                                                <canvas id="DAVAOCITYRA7687CHART" width="" height="500"></canvas>
                                            </div>

                                        </div>

                                    </div>
                                </div> --}}

                                {{-- COURSE COMPARISON --}}
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">DAVAO CITY RA7687</h5>
                                            <h6 class="card-subtitle text-muted">
                                                {{-- DESCRIPTIVE COMPARISON --}}
                                                <strong>

                                                </strong>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-contatiner">
                                                <canvas id="" width="" height="500"></canvas>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                                {{-- PIE PROGRAM CHART SECTION --}}
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">DAVAO CITY RA7687</h5>
                                            <h6 class="card-subtitle text-muted">
                                                {{-- DESCRIPTIVE COMPARISON --}}
                                                <strong>

                                                </strong>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-contatiner">
                                                <canvas id="PROGRAM" width="" height="100"></canvas>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">DAVAO CITY RA7687</h5>
                                            <h6 class="card-subtitle text-muted">
                                                {{-- DESCRIPTIVE COMPARISON --}}
                                                <strong>

                                                </strong>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-contatiner">
                                                <canvas id="COURSE" width="" height="500"></canvas>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="container mt-5" style="max-width: 450px">
                                <h2 class="mb-4">Laravel Bootstrap Datepicker Demo</h2>
                                <form method="GET" action="{{ route('dashboard') }}">
                                    <input type="text" class="form-control" name="startyear" id="datepicker" />
                                    <input type="text" class="form-control" name="endyear" id="datepicker2" />
                                    <input type="submit" value="Filter">
                                </form>
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
        $("#datepicker").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true //to close picker once year is selected
        });
        $("#datepicker2").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true //to close picker once year is selected
        });
        // Register the required plugins
        Chart.register([ChartDataLabels]);


        //START SCHOOLCHART
        var ctx = document.getElementById('SCHOOLSCHART').getContext('2d');


        var schoolCounts = @json($schoolCounts); // Extract the aggregated data from the PHP array
        var labels = Object.keys(schoolCounts);
        var data1 = Object.values(schoolCounts);

        // Set a solid blue color for all bars
        var backgroundColor = '#9FC5E8';
        var borderColor = 'rgba(54, 162, 235, 1)';

        var minValue = Math.min(...data1);
        var minIndices = data1.reduce((indices, value, index) => {
            if (value === minValue) {
                indices.push(index);
            }
            return indices;
        }, []);

        var maxValue = Math.max(...data1);
        var maxIndex = data1.indexOf(maxValue);

        // Set background color dynamically for each bar
        var dynamicBackgroundColors = data1.map((value, index) => {
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
                    data: data1,
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
        //END SCHOOLCHART






        //START PROGRAM
        var ongoingPROGRAM = @json($ongoingPROGRAM);
        var LABELsongoingRA787Data = ongoingPROGRAM.map(record => record.scholarshipprogram);
        var DATAsongoingRA787Data = @json($ongoingPROGRAM->pluck('scholarshipprogramcount'));

        var minValueprogram = Math.min(...DATAsongoingRA787Data);
        var minIndicesprogram = DATAsongoingRA787Data.reduce((indices, value, index) => {
            if (value === minValueprogram) {
                indices.push(index);
            }
            return indices;
        }, []);

        var maxValueprogram = Math.max(...DATAsongoingRA787Data);
        var maxIndex = DATAsongoingRA787Data.indexOf(maxValueprogram);

        var ctx = document.getElementById('PROGRAM').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: LABELsongoingRA787Data,
                datasets: [{
                    data: DATAsongoingRA787Data,
                    backgroundColor: ['rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                }]
            },
            options: {
                // maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        anchor: 'center',
                        align: 'center',
                        color: 'black',
                        textAlign: 'center',
                        font: {
                            style: 'italic',
                            weight: 'bold'
                        },
                        formatter: (value, context) => {
                            const dataIndex = context.dataIndex;
                            const datapoints = context.dataset.data;
                            const total = datapoints.reduce((total, datapoint) => total + datapoint, 0);
                            const percentage = (value / total) * 100;

                            let label = percentage.toFixed(1) + '%';

                            if (dataIndex === maxIndex) {
                                return 'High:\n' + label;
                            } else if (minIndicesprogram.includes(dataIndex)) {
                                return 'Low:\n' + label;
                            } else {
                                return label;
                            }
                        },
                    }
                }
            }
        });


        //COURSE
        var ongoingCOURSE = @json($ongoingCOURSE);
        var LABELongoingCOURSE = ongoingCOURSE.map(record => record.course);
        var DATAongoingCOURSE = @json($ongoingCOURSE->pluck('coursecount'));

        var minValueCOURSE = Math.min(...DATAongoingCOURSE);
        var minIndicesCOURSE = DATAongoingCOURSE.reduce((indices, value, index) => {
            if (value === minValueCOURSE) {
                indices.push(index);
            }
            return indices;
        }, []);

        var maxValueCOURSE = Math.max(...DATAongoingCOURSE);
        var maxIndexCOURSE = DATAongoingCOURSE.indexOf(maxValueCOURSE);

        var ctx = document.getElementById('COURSE').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: LABELongoingCOURSE,
                datasets: [{
                    data: DATAongoingCOURSE,
                    backgroundColor: ['rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        anchor: 'center',
                        align: 'center',
                        color: 'black',
                        textAlign: 'center',
                        font: {
                            style: 'italic',
                            weight: 'bold'
                        },
                        formatter: (value, context) => {
                            const dataIndex = context.dataIndex;
                            const datapoints = context.dataset.data;
                            const total = datapoints.reduce((total, datapoint) => total + datapoint, 0);
                            const percentage = (value / total) * 100;

                            let label = percentage.toFixed(1) + '%';

                            if (dataIndex === maxIndexCOURSE) {
                                return 'High:\n' + label;
                            } else if (minIndicesCOURSE.includes(dataIndex)) {
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
