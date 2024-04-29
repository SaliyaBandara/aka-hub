<?php
$HTMLHead = new HTMLHead($data['title']);
?>

<div style="overflow: hidden;">
    <div style="display: flex; justify-content: center; align-items: center; height: 100%; width: 100%; padding: 50px;">
        <div style="width: 60%; background-color: white; border-radius: 10px; padding: 20px;">
            <h1 style="text-align: center;"><span> ඇක </span><span style="color: #ff9b2d;"> HUB </span> Platform Analytics</h1>
            <p style="text-align: center;">
                <b><span style="color: #ff9b2d;">Administrator - </span><?php echo $_SESSION["user_name"]; ?></b>
            </p>
            <p style="text-align: center;">
                <b><span style="color: #ff9b2d;">Time - </span><?php echo date("Y-m-d h:i:sa"); ?></b>
            </p>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; height: 175px; z-index: +5; color: white; padding: 25px;">
                <div style="width: 27%; height: 100%; background-color: #2684FF; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); padding: 1rem; justify-content: center; align-items: center; text-align: center; display: flex; margin-left: 50px;">
                    <?php if ($data["count_total_users"] !== null) : ?>
                        <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                            <?= $data["count_total_users"] ?> Total Users
                        </div>
                    <?php endif; ?>
                </div>
                <div style="width: 27%; height: 100%; background-color: #ff9b2d; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); padding: 1rem; justify-content: center; align-items: center; display: flex;">
                    <?php if ($data["count_role_users"] !== null) : ?>
                        <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                            <?= $data["count_role_users"] ?> Users with Roles
                        </div>
                    <?php endif; ?>
                </div>
                <div style="width: 27%; height: 100%; background-color: #2684FF; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); padding: 1rem; justify-content: center; align-items: center; margin-right: 50px; display: flex;">
                    <?php if ($data["count_new_users"] !== null) : ?>
                        <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                            <?= $data["count_new_users"] ?> New Users
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div style="margin-top: 50px;">
                <div style="display: flex; justify-content: center; align-items: center;">
                    <div style="width: 50%; height: 100%; display: flex; justify-content: center; align-items: center; display: flex; flex-direction: column;">
                        <p style="margin-bottom: 1rem;"><b>User Registration For the System</b></p>
                        <div id="chartContainer1" style="height: 220px; width: 100%;"></div>
                    </div>
                    <div style="width: 50%; height: 100%; display: flex; justify-content: center; align-items: center; display: flex; flex-direction: column;">
                        <p style="margin-bottom: 1rem;"><b>Distribution of Users with Roles</b></p>
                        <div id="chartContainer2" style="height: 220px; width: 100%;"></div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; align-items: center; margin-top: 50px;">
                    <div style="width: 50%; height: 100%; display: flex; justify-content: center; align-items: center; display: flex; flex-direction: column;">
                        <p style="margin-bottom: 1rem;"><b>User Engagement in the System</b></p>
                        <div id="chartContainer4" style="height: 220px; width: 100%;"></div>
                    </div>
                    <div style="width: 50%; height: 100%; display: flex; justify-content: center; align-items: center; display: flex; flex-direction: column;">
                        <p style="margin-bottom: 1rem;"><b>User Distribution in 4 years</b></p>
                        <div id="chartContainer3" style="height: 220px; width: 100%;"></div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; align-items: center; margin-top: 50px;">
                    <div style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; display: flex; flex-direction: column;">
                        <p style="margin-bottom: 1rem;"><b>Counselor Reservation Requests</b></p>
                        <div id="chartContainer5" style="height: 220px; width: 100%; padding: 20px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var dataPoints = <?php echo json_encode($data["chartOne"], JSON_NUMERIC_CHECK); ?>;
        var chart1 = new CanvasJS.Chart("chartContainer1", {
            backgroundColor: "transparent",
            animationEnabled: true,
            exportEnabled: true,
            axisY: {
                title: "Yearly Users",
            },
            data: [{
                type: "spline",
                markerSize: 5,
                xValueFormatString: "DD",
                xValueType: "dateTime",
                dataPoints: dataPoints
            }]
        });

        chart1.render();
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var dataPoints = <?php echo json_encode($data["chartTwo"], JSON_NUMERIC_CHECK); ?>;
        var chart2 = new CanvasJS.Chart("chartContainer2", {
            backgroundColor: "transparent",
            animationEnabled: true,
            exportEnabled: true,
            data: [{
                type: "pie",
                legendText: "{label}",
                indexLabelFontSize: 10,
                indexLabel: "{label}",
                yValueFormatString: "฿#,##0",
                dataPoints: dataPoints
            }]
        });

        chart2.render();
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var dataPoints = <?php echo json_encode($data["chartThree"], JSON_NUMERIC_CHECK); ?>;
        var chart3 = new CanvasJS.Chart("chartContainer3", {
            backgroundColor: "transparent",
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            axisY: {
                title: "Number of Students"
            },
            data: [{
                type: "column",
                dataPoints: dataPoints
            }]
        });

        chart3.render();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var dataPoints = <?php echo json_encode($data["chartFour"], JSON_NUMERIC_CHECK); ?>;
        var chart4 = new CanvasJS.Chart("chartContainer4", {
            backgroundColor: "transparent",
            animationEnabled: true,
            exportEnabled: true,
            data: [{
                type: "pie",
                legendText: "{label}",
                indexLabelFontSize: 10,
                indexLabel: "{label}",
                yValueFormatString: "฿#,##0",
                dataPoints: dataPoints
            }]
        });

        chart4.render();
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var dataPoints = <?php echo json_encode($data["chartFive"], JSON_NUMERIC_CHECK); ?>;
        var chart5 = new CanvasJS.Chart("chartContainer5", {
            backgroundColor: "transparent",
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            subtitles: [{
                backgroundColor: "#2eacd1",
                fontSize: 16,
                fontColor: "white",
                padding: 5
            }],
            legend: {
                fontFamily: "calibri",
                fontSize: 14,
            },
            data: [{
                type: "doughnut",
                startAngle: 90,
                dataPoints: dataPoints
            }]
        });

        chart5.render();
    });
</script>