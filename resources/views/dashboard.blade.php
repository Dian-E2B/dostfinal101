<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">

    {{-- SIDEBAR START --}}
    @include('layouts.sidebar')
    {{-- SIDEBAR END --}}



    <div class="main">
        @include('layouts.header')

        <main class="content">
            <div class="container-fluid p-0">
<div class="">

   <div class="row">
      <div class="col-lg-12 col-lg-6">
         <div class="card flex-fill w-100">
            <div class="card-header">
               <h5 class="card-title">Line Chart</h5>
               <h6 class="card-subtitle text-muted">A line chart is a way of plotting data points on a line.</h6>
            </div>
            <div class="card-body">
               <div id="chart-container">
                  <canvas id="myChart" width="100" height="100"></canvas>
               </div>
            </div>
         </div>
      </div>

      </div>

      <div class="col-12 col-lg-6">
         <div class="card">
            <div class="card-header">
               <h5 class="card-title">Doughnut Chart</h5>
               <h6 class="card-subtitle text-muted">Doughnut charts are excellent at showing the relational proportions between data.</h6>
            </div>
            <div class="card-body">
               <div class="chart chart-sm">
                  <canvas id="chartjs-doughnut"></canvas>
               </div>
            </div>
         </div>
      </div>

      <div class="col-12 col-lg-6">
         <div class="card">
            <div class="card-header">
               <h5 class="card-title">Pie Chart</h5>
               <h6 class="card-subtitle text-muted">Pie charts are excellent at showing the relational proportions between data.</h6>
            </div>
            <div class="card-body">
               <div class="chart chart-sm">
                  <canvas id="chartjs-pie"></canvas>
               </div>
            </div>
         </div>
      </div>

      <div class="col-12 col-lg-6">
         <div class="card">
            <div class="card-header">
               <h5 class="card-title">Radar Chart</h5>
               <h6 class="card-subtitle text-muted">A radar chart is a way of showing multiple data points and the variation between them.
               </h6>
            </div>
            <div class="card-body">
               <div class="chart">
                  <canvas id="chartjs-radar"></canvas>
               </div>
            </div>
         </div>
      </div>

      <div class="col-12 col-lg-6">
         <div class="card">
            <div class="card-header">
               <h5 class="card-title">Polar Area Chart</h5>
               <h6 class="card-subtitle text-muted">Polar area charts are similar to pie charts, but each segment has the same angle.</h6>
            </div>
            <div class="card-body">
               <div class="chart">
                  <canvas id="chartjs-polar-area"></canvas>
               </div>
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


<script>
   // JavaScript code for creating the Chart.js chart
   var ctx = document.getElementById('myChart').getContext('2d');

   // Extract the aggregated data from the PHP array
   var schoolCounts = @json($schoolCounts);

   var labels = Object.keys(schoolCounts);
   var data = Object.values(schoolCounts);

   // Generate an array of random colors
   var backgroundColors = labels.map(function () {
      return 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.2)';
   });

   var borderColor = 'rgba(75, 192, 192, 1)'; // Set a common border color

   var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
         labels: labels,
         datasets: [{
            label: 'Schools',
            data: data,
            backgroundColor: backgroundColors, // Different colors for each bar
            borderColor: borderColor,
            borderWidth: 1
         }]
      },
      options: {
         scales: {
            y: {
               beginAtZero: true
            }
         }
      }
   });
</script>

</html>
