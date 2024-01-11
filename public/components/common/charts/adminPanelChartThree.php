<?php
class AdminPanelChartThree
{
    public function render()
    {
        $yearlyStudentData = array(
            array("label" => "1st Year", "y" => 340, "color" => "#E7823A"),
            array("label" => "2nd Year", "y" => 330, "color" => "#546BC1"),
            array("label" => "3rd Year", "y" => 335, "color" => "#E7823A"),
            array("label" => "4th Year", "y" => 60, "color" => "#546BC1")
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
    }
}
?>
