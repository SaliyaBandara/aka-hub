<?php
class AdminPanelChartFour
{
    public function render()
    {
        ob_start(); // Start output buffering
?>

        <div id="chartContainer4" style="height: 220px; width: 90%;"></div>

        <script>
            // Initialize chart1 when the document is ready
            document.addEventListener("DOMContentLoaded", function() {
                var dataPoints = [];

                var chart = new CanvasJS.Chart("chartContainer4", {
                    animationEnabled: true,
                    theme: "light2",
                    zoomEnabled: true,
                    // title: {
                    //     text: "Bitcoin Price - 2017"
                    // },
                    axisY: {
                        title: "Post Sharing For Months",
                    },
                    data: [{
                        type: "line",
                        yValueFormatString: "$#,##0.00",
                        dataPoints: dataPoints
                    }]
                });

                function addData(data) {
                    var dps = data.price_usd;
                    for (var i = 0; i < dps.length; i++) {
                        dataPoints.push({
                            x: new Date(dps[i][0]),
                            y: dps[i][1]
                        });
                    }
                    chart.render();
                }

                $.getJSON("https://canvasjs.com/data/gallery/php/bitcoin-price.json", addData);
            });
        </script>

<!-- 
        <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
        <script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script> -->

<?php
    }
}
?>