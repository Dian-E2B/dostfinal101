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
            font-family: "Calibri", sans-serif;
            font-size: 12pt;
        }

        .sidebar {
            font-size: 12pt;
        }

        .portionicon {
            padding: 1px;
            margin-right: 5px;
            font-size: 12pt;
        }

        #programportioncounter-body {
            font-size: 17px;
        }

        .selectportion {
            padding: 10px;
        }


        .programportioncard,
        .genderportioncard {
            box-shadow: 1px 2px 5px 4px rgb(214, 214, 214);
        }
    </style>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">


            @include('layouts.sidebar') {{-- SIDEBAR START --}}


            <div class="main">
                @include('layouts.header') {{-- HEADER START --}}

                @include('dashboardbody')
            </div>
        </div>
    </body>
    {{-- CHART TOGGLING --}}
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/0.7.7/chartjs-plugin-zoom.js" integrity="sha512-qeclqxc+2KW7GtbmHcj/Ev5eBoYpPnuAcPqusYRIfvaC9OWHlDwu1BrIVPYvfNDG+SRIRiPIokiSvhlLJXDqsw==" crossorigin="anonymous"></script>


    <script>
        var ongoingPROGRAM;
        var startYears;
        var scholarshipPrograms;
        var datasets;

        /* Start ProgramChart */
        ongoingPROGRAM = @json($ongoingPROGRAM);
        startYears = [...new Set(ongoingPROGRAM.map(item => item.startyear))];
        scholarshipPrograms = [...new Set(ongoingPROGRAM.map(item => item.scholarshipprogram))];
        datasets = scholarshipPrograms.map(function(program, index) {
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

        /* ProgramChart Setup */
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

        /* ProgramChart Part */
        function getPredefinedColor(index) {
            var predefinedColors = ['#3498db', '#000000', '#49C4D3'];
            return predefinedColors[index % predefinedColors.length];
        }

        /* Start ProgamChartPortion*/
        var ctxPROGRAMPIE = document.getElementById('myPieChart').getContext('2d');
        var dataPROGRAM = @json($ongoingPROGRAMcounter);
        var labelsPROGRAM = [];
        var countsPROGRAM = [];

        dataPROGRAM.forEach(item => { // Use dataPROGRAM instead of data
            labelsPROGRAM.push(item.scholarshipprogram);
            countsPROGRAM.push(item.scholarshipprogramcount);
        });

        var myPieChart = new Chart(ctxPROGRAMPIE, {
            type: 'pie',
            data: {
                labels: labelsPROGRAM, // Use labelsPROGRAM
                datasets: [{
                    data: countsPROGRAM, // Use countsPROGRAM
                    backgroundColor: [
                        '#3498db',
                        '#000000',
                        '#49C4D3',
                    ],
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'left',
                },
                plugins: {
                    datalabels: {
                        formatter: (value, ctxPROGRAMPIE) => {
                            let sum = 0;
                            let dataArr = ctxPROGRAMPIE.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed() + "%";
                            return percentage;
                        }
                    }
                },
            },
        });

        /* Start GenderChart */
        ongoingGender = @json($ongoingGender);
        startYearsGender = [...new Set(ongoingGender.map(item => item.startyear))];
        scholarshipGender = [...new Set(ongoingGender.map(item => item.MF))];
        datasetsGender = scholarshipGender.map(function(gender, index) {
            return {
                label: gender,
                data: startYearsGender.map(year => {
                    var match = ongoingGender.find(item => item.startyear === year && item.MF === gender);
                    return match ? match.MFcount : 0;
                }),
                borderColor: getPredefinedColorGender(index),
                borderWidth: 3,
                fill: false,
                backgroundColor: getPredefinedColorGender(index), // Solid color for the area under the line
            };
        });

        /* Gender Chart Setup */
        var myGenderChart = document.getElementById('myGenderChart').getContext('2d');
        window.myGenderChart = new Chart(myGenderChart, {
            type: 'line',
            data: {
                labels: startYearsGender.map(String),
                datasets: datasetsGender,
            },
            options: {

                scales: {
                    x: {
                        type: 'category',
                        labels: startYearsGender.map(String),
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

        /* Gender Chart Colors */
        function getPredefinedColorGender(index) {
            var predefinedColors = ['#FFC0CB', '#A52A2A'];
            return predefinedColors[index % predefinedColors.length];
        }

        /* Gender Chart Proportion */
        var ctxgenderproportion = document.getElementById('myGenderPie').getContext('2d');
        var datagender = @json($ongoingGendercounter);
        var labelsgender = [];
        var countsgender = [];

        datagender.forEach(item => {
            labelsgender.push(item.MF);
            countsgender.push(item.MFcount);
        });

        var myGenderPieChart = new Chart(ctxgenderproportion, {
            type: 'pie',
            data: {
                labels: labelsgender,
                datasets: [{
                    data: countsgender,
                    backgroundColor: [
                        '#FFC0CB',
                        '#A52A2A',

                    ],
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'left',
                },
                plugins: {
                    datalabels: {
                        formatter: (value, ctxgenderproportion) => {
                            let sum = 0;
                            let dataArr = ctxgenderproportion.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed() + "%";
                            return percentage;
                        }
                    }
                },
            },
        });

        document.addEventListener("DOMContentLoaded", function(event) {
            /* Filter Submit */
            $('#programyearform').on('submit', function(e) {
                e.preventDefault();
                var $this = $(this);
                $.ajax({
                    url: $this.prop('action'),
                    method: 'POST',
                    data: $this.serialize(),
                }).done(function(response) {

                    console.log(response);
                    //Destroy the existing chart
                    if (window.myProgramChart) {
                        // window.myProgramChart.destroy();
                        ongoingPROGRAM = response.ongoingPROGRAM;
                        startYears = [...new Set(ongoingPROGRAM.map(item => item.startyear))];
                        scholarshipPrograms = [...new Set(ongoingPROGRAM.map(item => item.scholarshipprogram))];

                        myProgramChart.data.labels = startYears.map(String);
                        myProgramChart.data.datasets.forEach((dataset, index) => {
                            dataset.data = startYears.map(year => {
                                var match = ongoingPROGRAM.find(item => item.startyear === year && item.scholarshipprogram === scholarshipPrograms[index]);
                                return match ? match.scholarshipprogramcount : 0;
                            });
                        });

                        myProgramChart.update(); // Update the chart to reflect the changes
                    }

                    if (window.myPieChart) {
                        var dataPROGRAM = response.ongoingPROGRAMcounter;
                        var labelsPROGRAM = [];
                        var countsPROGRAM = [];

                        dataPROGRAM.forEach(item => { // Use dataPROGRAM instead of data
                            labelsPROGRAM.push(item.scholarshipprogram);
                            countsPROGRAM.push(item.scholarshipprogramcount);
                        });

                        myPieChart.data.labels = labelsPROGRAM; // Update the labels
                        myPieChart.data.datasets[0].data = countsPROGRAM; // Update the data
                        myPieChart.update(); // Update the chart
                    }


                }).catch(error => {
                    console.error('Error fetching or processing data:', error);
                });
            });

            $('#genderyearform').on('submit', function(e) {
                e.preventDefault();
                var $this = $(this);
                $.ajax({
                    url: $this.prop('action'),
                    method: 'POST',
                    data: $this.serialize(),
                }).done(function(response) {
                    console.log(response);
                    //Destroy the existing chart
                    if (window.myGenderChart) {
                        var ongoingGenderResponse = response.ongoingGender; // Rename to avoid conflict
                        var startYearsGenderResponse = [...new Set(ongoingGenderResponse.map(item => item.startyear))]; // Rename
                        var scholarshipGenderResponse = [...new Set(ongoingGenderResponse.map(item => item.MF))]; // Rename

                        myGenderChart.data.labels = startYearsGenderResponse.map(String);
                        myGenderChart.data.datasets.forEach((dataset, index) => {
                            dataset.data = startYearsGenderResponse.map(year => {
                                var match = ongoingGenderResponse.find(item => item.startyear === year && item.MF === scholarshipGenderResponse[index]);
                                return match ? match.MFcount : 0;
                            });
                        });

                        myGenderChart.update(); // Update the chart to reflect the changes
                    }

                    if (window.myGenderPieChart) {
                        var dataGender = response.ongoingGendercounter; // Use dataGender instead of dataPROGRAM
                        var labelsGender = [];
                        var countsGender = [];

                        dataGender.forEach(item => {
                            labelsGender.push(item.MF);
                            countsGender.push(item.MFcount);
                        });

                        myGenderPieChart.data.labels = labelsGender;
                        myGenderPieChart.data.datasets[0].data = countsGender;
                        myGenderPieChart.update();
                    }


                }).catch(error => {
                    console.error('Error fetching or processing data:', error);
                });
            });
        });
    </script>


</html>
