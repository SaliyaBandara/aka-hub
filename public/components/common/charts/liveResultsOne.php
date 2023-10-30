<?php
class LiveResultsOne
{
    public function render()
    {
        $dataPoints = array(
            array("label" => "Binura", "y" => 590),
            array("label" => "Viranga", "y" => 261),
            array("label" => "Mushahid", "y" => 158),
            array("label" => "Amir", "y" => 72),
            array("label" => "Nipul", "y" => 191)
        );


        ob_start(); // Start output buffering
?>

        <div id="chartContainer2" style="height: 300px; width: 90%;"></div>

        <script>
            // Initialize chart2 when the document is ready
            document.addEventListener("DOMContentLoaded", function() {
                var chart2 = new CanvasJS.Chart("chartContainer2", {
                    animationEnabled: true,
                    exportEnabled: true,
                    // title: {
                    //     text: "Yearly Student Enrollment"
                    // },
                    // subtitles: [{
                    //     text: "Currency Used: Thai Baht (฿)"
                    // }],
                    data: [{
                        type: "pie",
                        showInLegend: "true",
                        legendText: "{label}",
                        indexLabelFontSize: 10,
                        indexLabel: "{label} - #percent%",
                        yValueFormatString: "฿#,##0",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                });

                chart2.render();
            });
        </script>

        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<?php
        return ob_get_clean(); // Return the buffered HTML content
    }
}
?>