<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("electionsAndPolls");
$chartOne = new LiveResultsOne();
$chartTwo = new LiveResultsTwo();
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Saliya", "Bandara"); ?>


    <div class="main-grid flex">
        <div class="left">
            <div id="electionDetails" class="text-center">University of Colombo School of Computing <br />
                Student Union Selection <br />
                2024
            </div>
            <div id="electionTime" class="text-muted text-center">Election ends in : 1hr 30min 4sec</div>

            <div class="threeCardDiv">
                <div class="cardTotalUsers">
                    <div class="divUsersContainor">
                        200 Votes
                    </div>
                </div>
                <div class="cardActiveUsers">
                    <div class="divUsersContainor">
                        350 Eligible Voters
                    </div>
                </div>
            </div>
            <div class="divChartContainor">
                <div class="divChart">
                    <?php echo $chartOne->render(); ?>
                </div>
                <div class="divChart">
                    <?php echo $chartTwo->render(); ?>
                </div>
            </div>
        </div>

        <div class="right"></div>
    </div>

    <style>
        .divChart {
            width: 50%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-grid {}

        .divChartContainor {
            width: 100%;
            height: 450px;
            display: flex;
        }

        .threeCardDiv {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
            height: 175px;
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
            margin-right: 50px;
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


        #electionDetails {
            text-align: center;
            font-weight: bold;
        }

        #activeElection {
            padding: 20px;
        }

        #electionTime {
            margin-top: 5px;
            font-size: 14px;
            font-style: italic;
        }

        .main-grid .left {
            width: 100%;
            /* background-color: yellowgreen; */
            height: 800px;
            padding: 2rem;
        }

        .main-grid .right {
            flex-grow: 1;
            background-color: yellowgreen;
            height: 150vh;
        }
    </style>

</div>

<?php $HTMLFooter = new HTMLFooter(); ?>

<script>
    $(document).ready(function() {

        $(document).on("click", ".forget-password", function(event) {
            event.preventDefault();
            $('.fixed-model').fadeIn();
            $('body').css('overflow', 'hidden');
        });

        // on click onsite_alert close_btn
        $(document).on("click", ".onsite_alert .close_btn", function(event) {
            event.preventDefault();

            $(this).parent().animate({
                opacity: 0
            }, 300, function() {
                $(this).slideUp(250, function() {
                    $(this).remove();
                });
            });


        });

    });
</script>