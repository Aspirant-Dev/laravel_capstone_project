<?php
            foreach ($getUsersCity as $key => $value) {
                $dataPoints[$key]['name'] = $getUsersCity[$key]['city'];
                $dataPoints[$key]['y'] = $getUsersCity[$key]['count'];
            }
        ?>
        <script>

            window.onload = function() {
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "dark2",
                    // exportFileName: "Doughnut Chart",
                    // exportEnabled: true,
                    animationEnabled: true,
                    title: {
                        text: "Users Registered City"
                    },
                    // legend:{
                    //     cursor: "pointer",
                    //     itemclick: explodePie
                    // },
                    data: [{
                        type: "doughnut",
                        // startAngle: 60,
                        innerRadius: 90,

                        showInLegend: true,
                        indexLabelFontSize: 17,
                        toolTipContent: "<b>{name}</b>: ${y} (#percent%)",
                        indexLabel: "{name} - #percent%",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK);?>
                    }]
                });
            chart.render();

            function explodePie (e) {
                if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
                    e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
                } else {
                    e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
                }
                e.chart.render();
                }
            }

        </script>
