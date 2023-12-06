
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

//START DAVAOCITYRA7687CHART
var ongoingRecords = @json($ongoingRecords);
var labels = ongoingRecords.map(record => record.school);
var recordCounts = @json($ongoingRecords->pluck('DAVAOCITY'));

var ctx = document.getElementById('DAVAOCITYRA7687CHART').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Record Count',
            data: recordCounts,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',

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
//END DAVAOCITYRA7687CHART

//START SCHOOLCHART
var ctx = document.getElementById('SCHOOLSCHART').getContext('2d');

// Extract the aggregated data from the PHP array
var schoolCounts = @json($schoolCounts);
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
        responsive: true,
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
</script>
