<?php
class LiveResultsTwo
{
    public function render()
    {
        $yearlyStudentData = array(
            array("label" => "Binura", "y" => 200, "color" => "#E7823A"),
            array("label" => "Viranga", "y" => 170, "color" => "#546BC1"),
            array("label" => "Mushahid", "y" => 261, "color" => "#E7823A"),
            array("label" => "Amir", "y" => 160, "color" => "#546BC1")
        );

        ob_start(); // Start output buffering
        ?>
        <!DOCTYPE HTML>
        <html>
        <head>
            <script>
                // Initialize chart when the document is ready
                document.addEventListener("DOMContentLoaded", function () {
                    var yearlyStudentData = <?php echo json_encode($yearlyStudentData, JSON_NUMERIC_CHECK); ?>;

                    var chart = new CanvasJS.Chart("chartContainer3", {
                        animationEnabled: true,
                        theme: "light2",
                        // title: {
                        //     text: "Student Batch Enrollment"
                        // },
                        axisY: {
                            title: "Number of Students"
                        },
                        data: [{
                            type: "column",
                            dataPoints: yearlyStudentData
                        }]
                    });

                    chart.render();
                });
            </script>
        </head>
        <body>
            <div id="chartContainer3" style="height: 220px; width: 100%;"></div>
        </body>
        </html>
        <?php
        return ob_get_clean(); // Return the buffered HTML content
    }
}
?>
