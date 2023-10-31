<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("electionDashboard");
$electionCard = new ElectionCard();
$prevElectionCard = new PrevElectionCard();
$calendar = new Calendar();

?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Saliya", "Bandara"); ?>
    <div class="main-grid flex">
        <div class="left">
            <div id = "ongoingElections">
                <div id = "ongoingTitle">Ongoing Elections</div>
                <?php echo $electionCard->render();
                    echo $electionCard->render();
                    echo $electionCard->render();
                    echo $electionCard->render();
                ?>
            </div>

            <div id = "previousElections">
                <div id = "previousTitle">Previous Elections</div>
                <?php echo $prevElectionCard->render();
                    echo $prevElectionCard->render();
                    echo $prevElectionCard->render();
                    echo $prevElectionCard->render();
                ?>
            </div>
        </div>
        <div class="right">
            <div class="calendarContainor">
                <?php echo $calendar->render(); ?>
            </div>
        </div>
    </div>

    <style>
        .main-grid{
            
        }

        .main-grid .left{
            width: 70%;
            background-color: white;
            height: 150vh;
        }
        .main-grid .right{
            flex-grow: 1;
            height: 50vh;
            margin-left : 20px;
        }

        .main-grid .right .calendarContainor{
            margin-left : 30px;
        }


        #ongoingTitle , #previousTitle{
            margin-left : 20px;
            font-weight : bold;
        }

        #previousElections {
            margin-top : 50px;
        }


    </style>

</div>
