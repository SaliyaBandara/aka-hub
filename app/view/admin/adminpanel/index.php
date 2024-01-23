<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("adminpanel");
$chartOne = new AdminPanelChartOne();
$chartTwo = new AdminPanelChartTwo();
$chartThree = new AdminPanelChartThree();
$chartFour = new AdminPanelChartFour();
$chartFive = new AdminPanelChartFive();
$calendar = new Calendar();
?>

<div id="sidebar-active" class="hideScrollbar">

    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left">

            <div class="threeCardDiv">
                <div class="cardTotalUsers">
                    <div class="divUsersContainor">
                        1200 Total Users
                    </div>
                </div>
                <div class="cardActiveUsers">
                    <div class="divUsersContainor">
                        1000 Active Users
                    </div>
                </div>
                <div class="cardNewUsers">
                    <div class="divUsersContainor">
                        200 New Users
                    </div>
                </div>
            </div>
            <div class="fourGraphsContainor">
                <div class="graphLineContainor">
                    <div class="graphContainor">
                        <?php echo $chartFive->render(); ?>
                    </div>
                    <div class="graphContainor">
                        <?php echo $chartTwo->render(); ?>
                    </div>
                </div>
                <div class="graphLineContainor">
                    <div class="graphContainor">
                        <?php echo $chartThree->render(); ?>
                    </div>
                    <div class="graphContainor">
                        <?php echo $chartFour->render(); ?>
                    </div>
                </div>
                <div class="graphLineContainor">
                    <div class="graphContainorFive">
                        <?php echo $chartOne->render(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="calendarContainor">
                <?php echo $calendar->render(); ?>
            </div>
        </div>
    </div>

    <style>
        .main-grid .left {
            width: 75%;
            height: 150vh;

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
        }

        .cardTotalUsers:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
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
        }

        .cardActiveUsers:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
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
        }

        .cardNewUsers:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
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
        }

        .graphContainorFive {
            width: 50%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</div>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>