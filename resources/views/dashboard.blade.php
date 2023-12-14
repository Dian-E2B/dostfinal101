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
        #programportioncounter td {
       vertical-align: middle !important;
        }

        body {
            font-family:"Calibri", sans-serif;
            font-size: 12pt;
        }

        .sidebar{
            font-size: 12pt;
        }

        .portionicon{
            padding: 1px;
            margin-right: 5px;
            font-size: 12pt;
        }

        #programportioncounter-body{
            font-size: 17px;
        }

        .selectportion{
            padding: 10px;
        }


       .programportioncard
       {
            box-shadow: 1px 2px 5px 4px rgb(214, 214, 214);
        }
    </style>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">


            @include('layouts.sidebar')  {{-- SIDEBAR START --}}


            <div class="main">
                @include('layouts.header') {{-- HEADER START --}}

                @include('dashboardbody')
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

        //START PROGRAMCHART
        function initiateprogramchart() {
            var ongoingPROGRAM = @json($ongoingPROGRAM);
            var startYears = [...new Set(ongoingPROGRAM.map(item => item.startyear))];
            var scholarshipPrograms = [...new Set(ongoingPROGRAM.map(item => item.scholarshipprogram))];

            var datasets = scholarshipPrograms.map(function(program, index) {
                return {
                    label: program,
                    data: startYears.map(year => {
                        var match = ongoingPROGRAM.find(item => item.startyear === year && item.scholarshipprogram === program);
                        return match ? match.scholarshipprogramcount : 0;
                    }),
                    borderColor: getPredefinedColor(index),
                    borderWidth: 3,
                    fill: false,
                    backgroundColor: getPredefinedColor(index), // Solid color for the area under the line
                };
            });

            //PROGRAMCHART SETUPS
            var myProgramChart = document.getElementById('myProgramChart').getContext('2d');
            window.myProgramChart = new Chart(myProgramChart, {
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
                            beginAtZero: !0,
                        },
                    },
                    elements: {
                        line: {
                            tension: 0.4,
                        },
                    },
                    legend: {
                        display: !0,
                        labels: {
                            boxWidth: 20,
                            usePointStyle: !0,
                        },
                    },
                    plugins: {
                        tooltip: {
                            mode: 'index',
                            intersect: !1,
                        },
                        zoom: {
                            pan: {
                                enabled: !0,
                                mode: 'xy',
                            },
                            zoom: {
                                enabled: !0,
                                mode: 'xy',
                            },
                        },
                    },
                },
            });

            function getPredefinedColor(index) {
                var predefinedColors = ['#3498db', '#000000', '#49C4D3'];
                return predefinedColors[index % predefinedColors.length];
            }
        }

        document.addEventListener("DOMContentLoaded", function(event) {
            initiateprogramchart(); //CALL MAINPROGRAM CHART

             //ON SUBMIT FILTER, DESTROY OLD AND CREATE NEW PROGRAM CHART
            $('#programyearform').on('submit', function(e) {
                e.preventDefault();
                var $this = $(this);
                $.ajax({
                    url: $this.prop('action'),
                    method: 'POST',
                    data: $this.serialize(),
                }).done(function(response) {
                    // Destroy the existing chart
                    if (window.myProgramChart) {
                        window.myProgramChart.destroy();
                    }

                    updateProgramTable(response.htmlContent);  //PROGRAMCHART PORTION SECTION

                    // console.log(response); //VIEW RESPONSES

                    var ongoingPROGRAM = response.ongoingPROGRAM;
                    var startYears = [...new Set(ongoingPROGRAM.map(item => item.startyear))];
                    var scholarshipPrograms = [...new Set(ongoingPROGRAM.map(item => item.scholarshipprogram))];

                    var datasets = scholarshipPrograms.map(function(program, index) {
                        return {
                            label: program,
                            data: startYears.map(year => {
                                var match = ongoingPROGRAM.find(item => item.startyear === year && item.scholarshipprogram === program);
                                return match ? match.scholarshipprogramcount : 0;
                            }),
                            borderColor: getPredefinedColor(index),
                            borderWidth: 3,
                            fill: false,
                            backgroundColor: getPredefinedColor(index), // Solid color for the area under the line
                        };
                    });

                    var newChart = document.getElementById('myProgramChart').getContext('2d');
                    window.myProgramChart = new Chart(newChart, {
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
                                    tension: 0.4, // Make the lines straight
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

                    function getPredefinedColor(index) {
                        var predefinedColors = ['#3498db', '#000000', '#49C4D3'];
                        return predefinedColors[index % predefinedColors.length];
                    }

                    function updateProgramTable(updatedData) {
                        var containerDiv = $('#programportioncounter-body');

                        containerDiv.empty(); // or containerDiv.html(''); // Clear existing content
                        // Update the content of the div
                        containerDiv.html(updatedData);
                    }

                }).catch(error => {
                    console.error('Error fetching or processing data:', error);
                    // You can add further error handling here, such as displaying an error message to the user
                });
            });
        });
    </script>


</html>
