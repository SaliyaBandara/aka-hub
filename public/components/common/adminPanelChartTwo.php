<?php
class AdminPanelChartTwo
{
    public function render()
    {
        $dataPoints = array(
            array("label" => "Courses", "y" => 590),
            array("label" => "Club Feeds", "y" => 261),
            array("label" => "Counselor Engagement", "y" => 158),
            array("label" => "Public Forum", "y" => 72),
            array("label" => "Elections", "y" => 191)
        );


        ob_start(); // Start output buffering
?>

        <div id="chartContainer2" style="height: 370px; width: 90%; box-shadow: 0 0 10px rgba(0, 0, 0, 0.23);"></div>

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