<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("viewlogs");
$calendar = new CalendarComponent();
?>

<div id="sidebar-active" class="hideScrollbar">

    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left w-100">
            <div class="section_header mb-1 flex">
                <div class="title font-1-5 font-semibold flex align-center">
                    <i class='bx bxs-calendar-check me-0-5'></i> User Logs and Analytics
                </div>
                <div class="mb-1 form-group right_side">
                    <a href="<?= BASE_URL ?>/viewlogs" class="btn btn-info">Back
                    </a>
                    <a href="<?= BASE_URL ?>/viewlogs" class="btn btn-info">
                        Export
                    </a>
                </div>
            </div>
            <div class="cardRowPanel">
                <div class="cardOdd">
                    <?php if ($data["unauthorized"] !== null) : ?>
                        <div class="cardOddContainor">
                            <?= $data["unauthorized"] ?> Unauthorized Attempts
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cardEven">
                    <?php if ($data["created"] !== null) : ?>
                        <div class="cardEvenContainor">
                            <?= $data["created"] ?> Users Created
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cardOdd">
                    <?php if ($data["deleted"] !== null) : ?>
                        <div class="cardOddContainor">
                            <?= $data["deleted"] ?> Users Deleted
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cardEven">
                    <?php if ($data["logged"] !== null) : ?>
                        <div class="cardEvenContainor">
                            <?= $data["logged"] ?> Logged In Count
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cardOdd">
                    <?php if ($data["granted"] !== null) : ?>
                        <div class="cardOddContainor">
                            <?= $data["granted"] ?> Permissions Grants
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cardEven">
                    <?php if ($data["revoked"] !== null) : ?>
                        <div class="cardEvenContainor">
                            <?= $data["revoked"] ?> Permissions Revoked
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="graphsContainor">
                <div class="graphLineContainor">
                    <div class="graphContainor">
                        <p class="mb-1"><b>Loging time periods to platform</b></p>
                        <div id="chartContainer1" style="height: 220px; width: 100%;"></div>
                    </div>
                    <div class="graphContainor">
                        <p class="mb-1"><b>Status Codes Frequency Distribution</b></p>
                        <div id="chartContainer2" style="height: 220px; width: 100%;"></div>
                    </div>
                </div>
                <div class="graphLineContainor">
                    <div class="graphContainor">
                        <p class="mb-1"><b>Success Rate of Operations</b></p>
                        <div id="chartContainer4" style="height: 220px; width: 100%;"></div>
                    </div>
                    <div class="graphContainor">
                        <p class="mb-1"><b>User activity on User Accounts</b></p>
                        <div id="chartContainer3" style="height: 220px; width: 100%;"></div>
                    </div>
                </div>
                <div class="graphLineContainor">
                    <div class="graphContainorFive">
                        <p class="mb-1"><b>Permission Grants And Revokes</b></p>
                        <div id="chartContainer5" style="height: 220px; width: 100%; padding:20px"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="right">
            <div class="calendarContainor">
                <?php echo $calendar->render(); ?>
            </div>
        </div> -->
    </div>

    <style>
        .graphsContainor {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: auto;
        }

        .section_header {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .main-grid .left {
            width: 100%;
            height: auto;
            padding-bottom: 50px;
        }

        .main-grid .right {
            flex-grow: 1;
            height: 150vh;
        }

        .cardRowPanel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            height: 175px;
            width: 100%;
            z-index: +5;
            color: white;
            padding: 25px;
        }

        .cardOdd {
            width: 15%;
            height: 100%;
            background-color: #2684FF;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            padding: 1rem;
            margin: 1rem;
            justify-content: center;
            align-items: center;
            text-align: center;
            display: flex;
            transition-duration: 0.5s;
            cursor: pointer;
        }

        .cardOdd:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            transition-duration: 0.5s;
            cursor: pointer;
        }

        .cardEven {
            width: 15%;
            height: 100%;
            background-color: #ff9b2d;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            padding: 1rem;
            justify-content: center;
            align-items: center;
            display: flex;
            transition-duration: 0.5s;
            cursor: pointer;
        }

        .cardEven:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            transition-duration: 0.5s;
            cursor: pointer;
        }


        .cardEvenContainor {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .cardOddContainor {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .graphLineContainor {
            height: 100%;
            width: 100%;
            display: flex;
            margin-top: 50px;
            justify-content: center;
            align-items: center;
        }

        .graphContainor {
            width: 55%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .graphContainorFive {
            width: 50%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            display: flex;
            flex-direction: column;
        }
    </style>

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
            data: [{
                type: "column",
                // showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 10,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "฿#,##0",
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
                // showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 10,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "฿#,##0",
                dataPoints: dataPoints
            }]
        });

        chart2.render();
    });
</script>

<script>
    // Initialize chart when the document is ready
    document.addEventListener("DOMContentLoaded", function() {
        var dataPoints = <?php echo json_encode($data["chartThree"], JSON_NUMERIC_CHECK); ?>;
        var chart3 = new CanvasJS.Chart("chartContainer3", {
            backgroundColor: "transparent",
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            axisY: {
                title: "User Activity Count"
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
                // showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 10,
                indexLabel: "{label} - #percent%",
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