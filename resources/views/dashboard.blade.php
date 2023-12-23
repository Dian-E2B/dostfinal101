<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/all.css') }}">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



    </head>
    <style>
        #programportioncounter td {
            vertical-align: middle !important;
        }

        body {
            font-family: "Calibri", sans-serif;
            /*   font-size: 12pt; */
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

        /* .selectportion {
            padding: 10px;
        } */

        .card {
            padding: 2%;
            margin-top: 6px !important;
            margin-bottom: 6px !important;
        }

        .gendercard,
        .programcard {
            margin-botom: 0% !important;
        }

        .coursecard {
            margin-top: 0% !important;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.1/chart.min.js"
        integrity="sha512-2uu1jrAmW1A+SMwih5DAPqzFS2PI+OPw79OVLS4NJ6jGHQ/GmIVDDlWwz4KLO8DnoUmYdU8hTtFcp8je6zxbCg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/2.0.1/chartjs-plugin-zoom.min.js"></script>


    <script>
        Chart.register(ChartDataLabels);
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
                    var match = ongoingPROGRAM.find(item => item.startyear === year && item
                        .scholarshipprogram === program);
                    return match ? match.scholarshipprogramcount : 0;
                }),
                borderColor: getPredefinedColor(index),
                borderWidth: 3,
                fill: false,
                backgroundColor: getPredefinedColor(index), // Solid color for the area under the line
            };
        });

        /* customize x label (program) */
        var labelsprogram = startYears.map((year, index) => {
            if (index < startYears.length - 1) {
                return year + "-" + (year + 1);
            } else {
                return year + "-" + (year + 1);
            }
        });


        /* ProgramChart Setup */
        var myProgramChart = document.getElementById('myProgramChart').getContext('2d');
        window.myProgramChart = new Chart(myProgramChart, {
            type: 'line',
            data: {
                labels: labelsprogram,
                datasets: datasets,
            },
            options: {
                animation: {
                    tension: {
                        duration: 2000,
                        easing: 'linear',
                        from: 0.4,
                        to: 0,
                        loop: true
                    }
                },
                responsive: true,

                scales: {
                    x: {
                        type: 'category',
                        labels: labelsprogram,
                    },
                    y: {
                        beginAtZero: !0,
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
                    datalabels: {
                        color: 'black', // change this to your preferred color
                        font: {
                            weight: 'bold',
                            size: 11.5 // change this to your preferred font size
                        },
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: !1,
                    },
                    zoom: {
                        zoom: {
                            wheel: {
                                enabled: true,
                            },
                            pinch: {
                                enabled: true
                            },
                            mode: 'x',
                        }
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
                maintainAspectRatio: false,
                animation: {
                    duration: 1500,
                    easing: 'linear',

                },

                plugins: {
                    legend: {
                        position: 'left',
                    },
                    datalabels: {
                        formatter: (value, ctxPROGRAMPIE) => {
                            let sum = 0;
                            let dataArr = ctxPROGRAMPIE.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed(1) + "%";
                            return percentage;
                        },
                        color: 'green', // change this to your preferred color
                        font: {
                            weight: 'bold',
                            size: 11.5 // change this to your preferred font size
                        },
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

        /* customize x label (gender) */
        var labelsprogram = startYearsGender.map((year, index) => {
            if (index < startYearsGender.length - 1) {
                return year + "-" + (year + 1);
            } else {
                return year + "-" + (year + 1);
            }
        });

        /* Gender Chart Setup */
        var myGenderChart = document.getElementById('myGenderChart').getContext('2d');
        window.myGenderChart = new Chart(myGenderChart, {
            type: 'line',
            data: {
                labels: labelsprogram,
                datasets: datasetsGender,
            },
            options: {
                animation: {
                    tension: {
                        duration: 2000,
                        easing: 'linear',
                        from: 0.4,
                        to: 0,
                        loop: true
                    }
                },

                scales: {
                    x: {
                        type: 'category',
                        labels: labelsprogram,
                    },
                    y: {
                        beginAtZero: !0,
                    },
                },
                plugins: {
                    datalabels: {
                        color: 'black', // change this to your preferred color
                        font: {
                            weight: 'bold',
                            size: 11.5 // change this to your preferred font size
                        },
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: !1,
                    },
                    zoom: {
                        pan: {
                            enabled: true,
                            mode: 'x',
                        },
                        zoom: {
                            enabled: true,
                            mode: 'x',
                        },
                    },
                    legend: {
                        display: !0,
                        labels: {
                            boxWidth: 20,
                            usePointStyle: !0,
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
                    backgroundColor: ['#FFC0CB', '#A52A2A', ],
                }]
            },
            options: {


                maintainAspectRatio: false,
                animation: {
                    duration: 1500, // duration of the animation in milliseconds
                    easing: 'linear', // easing function to use

                },
                responsive: true,

                plugins: {
                    legend: {
                        position: 'left',
                    },
                    datalabels: {

                        formatter: (value, ctxgenderproportion) => {
                            let sum = 0;
                            let dataArr = ctxgenderproportion.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed(1) + "%";
                            return percentage;
                        },
                        color: 'black', // change this to your preferred color
                        font: {
                            weight: 'bold'
                        },
                    },
                },
            },
        });

        /* Start Of Course Chart */
        var ctxcourse = document.getElementById('myCoursesChart').getContext('2d');
        var myCoursesChart = new Chart(ctxcourse, {
            type: 'bar',
            data: {
                labels: @json($dataCourses['labelscourses']),
                datasets: [{
                    label: 'Scholarship Courses Currently Availed ',
                    data: @json($dataCourses['datascourses']),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                onClick: function(event, elements) {
                    // Check if a bar was clicked
                    if (elements.length > 0) {
                        // Access the clicked bar's data
                        var clickedLabel = myCoursesChart.data.labels[elements[0].index];
                        var clickedValue = myCoursesChart.data.datasets[0].data[elements[0].index];

                        // Your custom logic when a bar is clicked
                        console.log('Clicked:', clickedLabel, 'with value:', clickedValue);
                    }
                },
                animation: {
                    duration: 5000,
                    easing: 'easeOutQuart',
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: 'black',

                    }
                },
            },
        });

        /* ongoingProvinces chart */
        var ctxprovinces = document.getElementById('myProvincesChart').getContext('2d');
        var provincesColors = ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(255, 205, 86, 0.2)',
            'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)'
        ]; // Add more colors as needed
        window.myProvinceChart = new Chart(ctxprovinces, {
            type: 'doughnut',
            data: {
                labels: @json($dataProvinces['labelsprovince']),
                datasets: [{
                    label: @json($dataProvinces['labelsprovince']),
                    data: @json($dataProvinces['datasprovince']),
                    backgroundColor: provincesColors,

                    borderWidth: 2
                }]
            },
            options: {

                plugins: {
                    datalabels: {
                        color: 'black',
                        formatter: (value) => {
                            return value + '%';
                        },
                    },
                    legend: {
                        position: 'left',
                    },
                },
                maintainAspectRatio: false,
                animation: {
                    duration: 5000,
                    easing: 'easeOutQuart',
                },

            },
        });


        document.addEventListener("DOMContentLoaded", function(event) {
            /* Filter Submit Program */
            $('#programyearform').on('submit', function(e) {
                e.preventDefault();
                var $this = $(this);
                $.ajax({
                    url: $this.prop('action'),
                    method: 'POST',
                    data: $this.serialize(),
                }).done(function(response) {

                    // console.log(response);
                    //Destroy the existing chart
                    if (window.myProgramChart) {
                        // window.myProgramChart.destroy();
                        ongoingPROGRAM = response.ongoingPROGRAM;
                        startYears = [...new Set(ongoingPROGRAM.map(item => item.startyear))];
                        scholarshipPrograms = [...new Set(ongoingPROGRAM.map(item => item
                            .scholarshipprogram))];


                        /* customize x label (program) */
                        var labelsprogram = startYears.map((year, index) => {
                            if (index < startYears.length - 1) {
                                return year + "-" + (year + 1);
                            } else {
                                return year + "-" + (year + 1);
                            }
                        });
                        myProgramChart.data.labels = labelsprogram;
                        myProgramChart.data.datasets.forEach((dataset, index) => {
                            dataset.data = startYears.map(year => {
                                var match = ongoingPROGRAM.find(item => item
                                    .startyear === year && item
                                    .scholarshipprogram ===
                                    scholarshipPrograms[
                                        index]);
                                return match ? match.scholarshipprogramcount :
                                    0;
                            });
                        });
                        myProgramChart.reset();
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

            /* Filter Submit Gender */
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

                        var ongoingGenderResponse = response
                            .ongoingGender; // Rename to avoid conflict
                        var startYearsGenderResponse = [...new Set(ongoingGenderResponse.map(
                            item =>
                            item.startyear))]; // Rename
                        var scholarshipGenderResponse = [...new Set(ongoingGenderResponse.map(
                            item => item.MF))]; // Rename
                        /* customize x label (program) */
                        var labelsgender = startYears.map((year, index) => {
                            if (index < startYears.length - 1) {
                                return year + "-" + (year + 1);
                            } else {
                                return year + "-" + (year + 1);
                            }
                        });
                        myGenderChart.data.labels = labelsgender;
                        myGenderChart.data.datasets.forEach((dataset, index) => {
                            dataset.data = startYearsGenderResponse.map(year => {
                                var match = ongoingGenderResponse.find(item =>
                                    item
                                    .startyear === year && item.MF ===
                                    scholarshipGenderResponse[index]);
                                return match ? match.MFcount : 0;
                            });
                        });

                        myGenderChart.update(); // Update the chart to reflect the changes
                    }

                    if (window.myGenderPieChart) {

                        var dataGender = response
                            .ongoingGendercounter; // Use dataGender instead of dataPROGRAM
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



            $('#provinceyearform').on('submit', function(e) {
                e.preventDefault();
                var $this = $(this);
                $.ajax({
                    url: $this.prop('action'),
                    method: 'POST',
                    data: $this.serialize(),
                }).done(function(response) {
                    /*  console.log(response); */
                    //Destroy the existing chart
                    if (window.myProvinceChart && response.dataProvinces.labelsprovince && response
                        .dataProvinces.datasprovince) {
                        // Update the chart data
                        myProvinceChart.data.labels = response.dataProvinces.labelsprovince;
                        myProvinceChart.data.datasets[0].data = response.dataProvinces
                            .datasprovince;

                        // Update the chart
                        myProvinceChart.update();
                    }



                }).catch(error => {
                    console.error('Error fetching or processing data:', error);
                });
            });

        });



        /* ongoingSchools */
        var ctxschools = document.getElementById('mySchoolChart').getContext('2d');
        /*  var schoolsColors = ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(255, 205, 86, 0.2)',
             'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)'
         ]; // Add more colors as needed */
        var mySchoolChart = new Chart(ctxschools, {
            type: 'doughnut',
            data: {
                labels: @json($dataSchoool['labelsschool']),
                datasets: [{
                    label: @json($dataSchoool['labelsschool']),
                    data: @json($dataSchoool['datasschool']),
                    borderWidth: 2
                }]
            },
            options: {

                plugins: {
                    datalabels: {
                        color: 'black',
                        formatter: (value) => {
                            return value + '%';
                        },
                    },
                    legend: {
                        position: 'left',
                    },
                },
                maintainAspectRatio: false,
                animation: {
                    duration: 5000,
                    easing: 'easeOutQuart',
                },

            },
        });

        /* ongoingMovement */
        var ctxmovement = document.getElementById('myMovementChart').getContext('2d');
        /*  var schoolsColors = ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(255, 205, 86, 0.2)',
             'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)'
         ]; // Add more colors as needed */
        var myMovementChart = new Chart(ctxmovement, {
            type: 'doughnut',
            data: {

                labels: @json($dataMovements['labelsmovements']),
                datasets: [{
                    label: @json($dataMovements['labelsmovements']),
                    data: @json($dataMovements['datasmovements']),
                    borderWidth: 2
                }]
            },
            options: {

                plugins: {
                    datalabels: {
                        color: 'black',
                        formatter: (value) => {
                            return value + '%';
                        },
                    },
                    legend: {
                        position: 'left',
                    },
                },
                maintainAspectRatio: false,
                animation: {
                    duration: 5000,
                    easing: 'easeOutQuart',
                },

            },
        });
    </script>


</html>
