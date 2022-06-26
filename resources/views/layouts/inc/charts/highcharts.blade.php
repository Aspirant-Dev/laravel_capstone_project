<script src="https://code.highcharts.com/highcharts.js"></script>

<div id="chart-container"></div>

<script>
    var salesData = <?php echo json_encode($salesData) ?>;
    Highcharts.chart('chart-container',{
        title: {
            text: "Sales Graph"
        },
        xAxis:{
            categories: ['january','february','march','april','may','june','july','august','september','october','november','december'],
        },
        yAxis:{
            title: {
                text: "Sales"
            }
        },
        series: [{
            name: "SALES",
            data: salesData
        }],
    });
</script>
