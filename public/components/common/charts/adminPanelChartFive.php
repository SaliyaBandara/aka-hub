<?php
class AdminPanelChartFive
{
    public function render()
    {
        $dataPoints1 = array(
            array("x" => 1451586600000, "y" => 96.709, "color" => "#E7823A"),
            array("x" => 1454265000000, "y" => 94.918, "color" => "#E7823A"),
            array("x" => 1456770600000, "y" => 95.152, "color" => "#E7823A"),
            array("x" => 1459449000000, "y" => 97.070, "color" => "#E7823A"),
            array("x" => 1462041000000, "y" => 97.305, "color" => "#E7823A"),
            array("x" => 1464719400000, "y" => 89.854, "color" => "#E7823A"),
            array("x" => 1467311400000, "y" => 88.158, "color" => "#E7823A"),
            array("x" => 1469989800000, "y" => 87.989, "color" => "#E7823A"),
            array("x" => 1472668200000, "y" => 86.366, "color" => "#E7823A"),
            array("x" => 1475260200000, "y" => 81.650, "color" => "#E7823A"),
            array("x" => 1477938600000, "y" => 85.789, "color" => "#E7823A"),
            array("x" => 1480530600000, "y" => 83.846, "color" => "#E7823A"),
            array("x" => 1483209000000, "y" => 84.927, "color" => "#E7823A"),
            array("x" => 1485887400000, "y" => 82.609, "color" => "#E7823A"),
            array("x" => 1488306600000, "y" => 81.428, "color" => "#E7823A"),
            array("x" => 1490985000000, "y" => 83.259, "color" => "#E7823A"),
            array("x" => 1493577000000, "y" => 83.153, "color" => "#E7823A"),
            array("x" => 1496255400000, "y" => 84.180, "color" => "#E7823A"),
            array("x" => 1498847400000, "y" => 84.840, "color" => "#E7823A"),
            array("x" => 1501525800000, "y" => 82.671, "color" => "#E7823A"),
            array("x" => 1504204200000, "y" => 87.496, "color" => "#E7823A"),
            array("x" => 1506796200000, "y" => 86.007, "color" => "#E7823A"),
            array("x" => 1509474600000, "y" => 87.233, "color" => "#E7823A"),
            array("x" => 1512066600000, "y" => 86.276, "color" => "#E7823A")
        );

        $dataPoints2 = array(
            array("x" => 1451586600000, "y" => 73.5555, "color" => "##2684FF"),
            array("x" => 1454265000000, "y" => 74.1625, "color" => "##2684FF"),
            array("x" => 1456770600000, "y" => 75.3980, "color" => "##2684FF"),
            array("x" => 1459449000000, "y" => 76.0965, "color" => "##2684FF"),
            array("x" => 1462041000000, "y" => 74.8165, "color" => "##2684FF"),
            array("x" => 1464719400000, "y" => 74.9660, "color" => "##2684FF"),
            array("x" => 1467311400000, "y" => 74.4805, "color" => "##2684FF"),
            array("x" => 1469989800000, "y" => 74.7355, "color" => "##2684FF"),
            array("x" => 1472668200000, "y" => 74.8155, "color" => "##2684FF"),
            array("x" => 1475260200000, "y" => 73.2275, "color" => "##2684FF"),
            array("x" => 1477938600000, "y" => 72.6315, "color" => "##2684FF"),
            array("x" => 1480530600000, "y" => 71.4610, "color" => "##2684FF"),
            array("x" => 1483209000000, "y" => 72.9025, "color" => "##2684FF"),
            array("x" => 1485887400000, "y" => 70.5750, "color" => "##2684FF"),
            array("x" => 1488306600000, "y" => 69.0955, "color" => "##2684FF"),
            array("x" => 1490985000000, "y" => 70.0565, "color" => "##2684FF"),
            array("x" => 1493577000000, "y" => 72.5320, "color" => "##2684FF"),
            array("x" => 1496255400000, "y" => 73.8350, "color" => "##2684FF"),
            array("x" => 1498847400000, "y" => 76.0255, "color" => "##2684FF"),
            array("x" => 1501525800000, "y" => 76.1465, "color" => "##2684FF"),
            array("x" => 1504204200000, "y" => 77.1570, "color" => "##2684FF"),
            array("x" => 1506796200000, "y" => 75.4075, "color" => "##2684FF"),
            array("x" => 1509474600000, "y" => 76.7690, "color" => "##2684FF"),
            array("x" => 1512066600000, "y" => 76.5950, "color" => "##2684FF")
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
                                showInLegend: true,
                                xValueType: "dateTime",
                                xValueFormatString: "MMM YYYY",
                                yValueFormatString: "₹#,##0.##",
                                dataPoints: <?php echo json_encode($dataPoints1); ?>
                            },
                            {
                                type: "area",
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
            <div id="chartContainer" style="height: 220px; width: 100%;"></div>
            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        </body>
        </html>
<?php
        return ob_get_clean(); // Return the buffered HTML content
    }
}
?>
