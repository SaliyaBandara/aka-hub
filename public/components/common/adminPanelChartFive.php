<?php
class AdminPanelChartFive
{
    public function render()
    {
        $dataPoints1 = array(
            array("x" => 1451586600000, "y" => 96.709),
            array("x" => 1454265000000, "y" => 94.918),
            array("x" => 1456770600000, "y" => 95.152),
            array("x" => 1459449000000, "y" => 97.070),
            array("x" => 1462041000000, "y" => 97.305),
            array("x" => 1464719400000, "y" => 89.854),
            array("x" => 1467311400000, "y" => 88.158),
            array("x" => 1469989800000, "y" => 87.989),
            array("x" => 1472668200000, "y" => 86.366),
            array("x" => 1475260200000, "y" => 81.650),
            array("x" => 1477938600000, "y" => 85.789),
            array("x" => 1480530600000, "y" => 83.846),
            array("x" => 1483209000000, "y" => 84.927),
            array("x" => 1485887400000, "y" => 82.609),
            array("x" => 1488306600000, "y" => 81.428),
            array("x" => 1490985000000, "y" => 83.259),
            array("x" => 1493577000000, "y" => 83.153),
            array("x" => 1496255400000, "y" => 84.180),
            array("x" => 1498847400000, "y" => 84.840),
            array("x" => 1501525800000, "y" => 82.671),
            array("x" => 1504204200000, "y" => 87.496),
            array("x" => 1506796200000, "y" => 86.007),
            array("x" => 1509474600000, "y" => 87.233),
            array("x" => 1512066600000, "y" => 86.276)
        );

        $dataPoints2 = array(
            array("x" => 1451586600000, "y" => 73.5555),
            array("x" => 1454265000000, "y" => 74.1625),
            array("x" => 1456770600000, "y" => 75.3980),
            array("x" => 1459449000000, "y" => 76.0965),
            array("x" => 1462041000000, "y" => 74.8165),
            array("x" => 1464719400000, "y" => 74.9660),
            array("x" => 1467311400000, "y" => 74.4805),
            array("x" => 1469989800000, "y" => 74.7355),
            array("x" => 1472668200000, "y" => 74.8155),
            array("x" => 1475260200000, "y" => 73.2275),
            array("x" => 1477938600000, "y" => 72.6315),
            array("x" => 1480530600000, "y" => 71.4610),
            array("x" => 1483209000000, "y" => 72.9025),
            array("x" => 1485887400000, "y" => 70.5750),
            array("x" => 1488306600000, "y" => 69.0955),
            array("x" => 1490985000000, "y" => 70.0565),
            array("x" => 1493577000000, "y" => 72.5320),
            array("x" => 1496255400000, "y" => 73.8350),
            array("x" => 1498847400000, "y" => 76.0255),
            array("x" => 1501525800000, "y" => 76.1465),
            array("x" => 1504204200000, "y" => 77.1570),
            array("x" => 1506796200000, "y" => 75.4075),
            array("x" => 1509474600000, "y" => 76.7690),
            array("x" => 1512066600000, "y" => 76.5950)
        );

        ob_start(); // Start output buffering
?>
        <!DOCTYPE HTML>
        <html>
        <head>
            <script>
                window.onload = function () {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        // title: {
                        //     text: "Comparison of Exchange Rates"
                        // },
                        // subtitles: [{
                        //     text: "GBP & EUR to INR",
                        //     fontSize: 18
                        // }],
                        // axisY: {
                        //     prefix: "₹"
                        // },
                        legend: {
                            cursor: "pointer",
                            itemclick: toggleDataSeries
                        },
                        toolTip: {
                            shared: true
                        },
                        data: [
                            {
                                type: "area",
                                name: "GBP",
                                showInLegend: true,
                                xValueType: "dateTime",
                                xValueFormatString: "MMM YYYY",
                                yValueFormatString: "₹#,##0.##",
                                dataPoints: <?php echo json_encode($dataPoints1); ?>
                            },
                            {
                                type: "area",
                                name: "EUR",
                                showInLegend: true,
                                xValueType: "dateTime",
                                xValueFormatString: "MMM YYYY",
                                yValueFormatString: "₹#,##0.##",
                                dataPoints: <?php echo json_encode($dataPoints2); ?>
                            }
                        ]
                    });

                    chart.render();

                    function toggleDataSeries(e) {
                        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                            e.dataSeries.visible = false;
                        }
                        else {
                            e.dataSeries.visible = true;
                        }
                        chart.render();
                    }
                }
            </script>
        </head>
        <body>
            <div id="chartContainer" style="height: 370px; width: 100%; box-shadow: 0 0 10px rgba(0, 0, 0, 0.23);"></div>
            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        </body>
        </html>
<?php
        return ob_get_clean(); // Return the buffered HTML content
    }
}
?>
