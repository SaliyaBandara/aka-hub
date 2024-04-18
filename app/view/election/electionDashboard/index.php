<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("electionDashboard");
$calendar = new Calendar();

?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="main-grid flex">
        <div class="left">
            <div class = "ongoingElections">
                <div class = "ongoingTitle">Ongoing Elections</div>
                <?php 
                    if (empty($data["electionsOngoing"])) {
                        echo '<div class = "emptyMessage"> There are no ongoing elections or polls! </div>';
                    } else {
                        foreach ($data["electionsOngoing"] as $electionsOngoing) {
                        ?>
                            <div class = "electionCard">
                                <div class = "electionCardTitle"><?= $electionsOngoing["name"] ?> is happening now....</div>
                                <div class = "electionCardTime" class="text-muted" >
                                    <?php
                                        $currentDateTime = new DateTime();
                                        $endDate = new DateTime($electionsOngoing["end_date"]);

                                        $dateDiff = $endDate->diff($currentDateTime);

                                        $remainingDays = $dateDiff->d;
                                        $remainingHours = $dateDiff->h;
                                        $remainingMinutes = $dateDiff->i;

                                        echo "Election ends in ";
                                        if ($remainingDays > 0) {
                                            echo $remainingDays . " days, ";
                                        }
                                        echo $remainingHours . " hours, and " . $remainingMinutes . " minutes.";
                                    ?>
                                </div>
                                <div class = "electionButton"><a href="<?= BASE_URL ?>/activeElection/index" class="mwb-form-submit-btn">Vote Now</a></div>
                                <!-- <div id = "electionButton"><input type = "button" value = "VOTE NOW!"><a href=""></a></div> -->
            
                            </div>
                        <?php } ?>
                    <?php } ?>
            </div>

            <div class = "previousElections">
                <div class = "previousTitle">Previous Elections</div>
                <?php 
                    if (empty($data["electionsPrevious"])) {
                        echo '<div class = "emptyMessage"> There are no previous elections or polls! </div>';
                    } else {
                        foreach ($data["electionsPrevious"] as $electionsPrevious) {
                        ?>
                            <div class = "electionCard">
                                <div class = "electionCardTitle"><?= $electionsPrevious["name"] ?></div>
                                <div class = "electionCardTime" class="text-muted" >Election ended on <?= $electionsPrevious["end_date"] ?></div>
                                <!-- <div id = "prevEelectionButton"><input type = "button" value = "View Results"></div> -->
                                <div class = "electionButton"><a href="<?= BASE_URL ?>/liveResults/index" class="mwb-form-submit-btn">View Results</a></div>
                            </div>
                        <?php } ?>
                    <?php } ?>
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
            width: 50%;
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


        .ongoingTitle , .previousTitle{
            margin-left : 20px;
            font-weight : bold;
        }

        .previousElections {
            margin-top : 50px;
        }

        .electionCard {
            display : flex;
            flex-direction : column;
            
            margin : 10px;
            margin-left : 20px;
            width: 800px;
            height: 90px;
            flex-shrink: 0;
            border-radius : 10px;
            border: 2px solid rgba(38, 132, 255, 0.41);
                
        }

        .electionCardTitle{
            padding : 10px 10px 5px;
            color: #2684FF;
            font-family: Inter;
            font-size: 16px;
            font-weight: 500;
        }

        .electionCardTime{
            font-size : 12px;
            padding-left : 10px;
        }

        .electionButton{
            align-self: flex-end;
            padding-right : 10px;
            padding-bottom : 10px;
        }

        .electionButton a{
            padding-right : 10px;
            border-radius: 10px;
            background: #2684FF;
            color : white;
            border : none;
            font-size : 14px;
            padding : 8px;
            text-decoration: none;
        }

        .electionButton a:hover{
            cursor: pointer;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            
        }

        .emptyMessage {
            padding : 10px 10px 5px 30px;
            color: #FF2400;
            font-family: Inter;
            font-size: 16px;
            font-weight: 500;
        }


    </style>



</div>
