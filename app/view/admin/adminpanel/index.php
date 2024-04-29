<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("adminpanel");
$calendar = new CalendarComponent();
?>

<style>
    /* css quiery for print */
    @page {
        size: A4 portrait;
        margin: 1%;
        margin: 50px 0% 0 0%;
        margin-top: 50px;
    }


    @media print {
        .noprint {
            display: none !important;
        }

        #sidebar {
            display: none;
        }

        /* show background colors */
        body {
            -webkit-print-color-adjust: exact;
        }

        #sidebar-active {
            width: 100vw;
            margin: 0 !important;
            padding: 0 !important;
            box-shadow: none !important;
        }

        .main-grid .left {
            width: 100% !important;
        }

        .main-grid .right {
            flex-grow: 1;
            /* height: 100vh; */
        }

    }
</style>

<div id="sidebar-active" class="hideScrollbar">

    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left">
            <div class="threeCardDiv">
                <div class="cardTotalUsers">
                    <?php if ($data["count_total_users"] !== null) : ?>
                        <div class="divUsersContainor">
                            <?= $data["count_total_users"] ?> Total Users
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cardActiveUsers">
                    <?php if ($data["count_role_users"] !== null) : ?>
                        <div class="divUsersContainor">
                            <?= $data["count_role_users"] ?> Users with Roles
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cardNewUsers">
                    <?php if ($data["count_new_users"] !== null) : ?>
                        <div class="divUsersContainor">
                            <?= $data["count_new_users"] ?> New Users
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="fourGraphsContainor">
                <div class="printDiv">
                    <a class="btn btn-info btn-download noprint" style="color:white; text-decoration:none;" href="javascript:window.print()">
                        Export
                    </a>

                </div>
                <div class="graphLineContainor">
                    <div class="graphContainor">
                        <p class="mb-1"><b>User Registration For the System</b></p>
                        <div id="chartContainer1" style="height: 220px; width: 100%;"></div>
                    </div>
                    <div class="graphContainor">
                        <p class="mb-1"><b>Distribution of Users with Roles</b></p>
                        <div id="chartContainer2" style="height: 220px; width: 100%;"></div>
                    </div>
                </div>
                <div class="graphLineContainor">
                    <div class="graphContainor">
                        <p class="mb-1"><b>User engagement in the System</b></p>
                        <div id="chartContainer4" style="height: 220px; width: 100%;"></div>
                    </div>
                    <div class="graphContainor">
                        <p class="mb-1"><b>User Distribution in 4 years</b></p>
                        <div id="chartContainer3" style="height: 220px; width: 100%;"></div>
                    </div>
                </div>
                <div class="graphLineContainor">
                    <div class="graphContainorFive">
                        <p class="mb-1"><b>Counselor Resevation Requests</b></p>
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
        /* .printDiv {
            width: 100%;
            height: 2rem;
            display: flex;
        }

        .printInnerDiv {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 5px;
            border-radius: 5px;
            background-color: white;
        }

        .printDiv img {
            width: 1.5rem;
            height: 1.5rem;
        } */

        .main-grid .left {
            width: 100%;
            height: 150vh;
            padding-bottom: 50px;
        }

        .main-grid .right {
            flex-grow: 1;
            height: 150vh;
        }

        .threeCardDiv {
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

        .cardTotalUsers {
            width: 27%;
            height: 100%;
            background-color: #2684FF;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            padding: 1rem;
            justify-content: center;
            align-items: center;
            text-align: center;
            display: flex;
            margin-left: 50px;
            transition-duration: 0.5s;
            ccursor: pointer;
        }

        .cardTotalUsers:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            transition-duration: 0.5s;
            cursor: pointer;
        }

        .cardActiveUsers {
            width: 27%;
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

        .cardActiveUsers:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            transition-duration: 0.5s;
            cursor: pointer;
        }

        .cardNewUsers {
            width: 27%;
            height: 100%;
            background-color: #2684FF;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            padding: 1rem;
            justify-content: center;
            align-items: center;
            margin-right: 50px;
            display: flex;
            transition-duration: 0.5s;
            cursor: pointer;
        }

        .cardNewUsers:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            transition-duration: 0.5s;
            cursor: pointer;
        }

        .divUsersContainor {
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script>
    function downloadPDF() {
        // Capture the entire webpage body
        html2canvas(document.body, {
            useCORS: true
        }).then(canvas => {
            downloadCanvasAsPDF(canvas, 'webpage.pdf');
        });
    }

    function downloadCanvasAsPDF(canvas, filename) {
        const dpi = window.devicePixelRatio || 1;
        const pdfWidth = canvas.width * 25.4 / dpi / 96; // 1 inch = 96 pixels
        const pdfHeight = canvas.height * 25.4 / dpi / 96;
        const scale = 1;

        const pdf = new window.jspdf.jsPDF({
            orientation: 'portrait', // Adjust orientation as needed
            unit: 'mm',
            format: [pdfWidth * scale, pdfHeight * scale],
        });

        pdf.addImage(
            canvas.toDataURL('image/png'),
            'PNG',
            0,
            0,
            pdfWidth * scale,
            pdfHeight * scale
        );

        pdf.save(filename);
    }
</script>