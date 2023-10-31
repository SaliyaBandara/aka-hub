<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("electionsAndPolls");
$candidateCard = new CandidateCard();
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Saliya", "Bandara"); ?>


    <div class="main-grid flex">
        <div class="left">
            <div id="activeElection">
                <div id="electionDetails" class="text-center">University of Colombo School of Computing <br />
                    Student Union Selection <br />
                    2024
                </div>
                <div id="electionTime" class="text-muted text-center">Election ends in : 1hr 30min 4sec</div>
                <div class="justify-between flex flex-wrap">
                    <?php echo $candidateCard->render();
                    echo $candidateCard->render();
                    echo $candidateCard->render();
                    echo $candidateCard->render();
                    echo $candidateCard->render();
                    echo $candidateCard->render();
                    echo $candidateCard->render();

                    ?>
                </div>
            </div>
        </div>
    </div>

    <style>
        .main-grid {}

        .main-grid .left {
            width: 100%;
            height: 300vh;
            margin: 20px;
        }

        #electionDetails {
            text-align: center;
            font-weight: bold;
        }

        #activeElection {
            padding-top: 20px;
        }

        #electionTime {
            margin-top: 5px;
            font-size: 14px;
            font-style: italic;
        }
    </style>

</div>
