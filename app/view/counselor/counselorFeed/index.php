<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("counselorFeed");
$feedArea = new feedArea();
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Saliya", "Bandara"); ?>


    <div class="main-grid flex">
        <div class="left">
            <h3 class="h3-CounselorFeed">Counselor Feed</h3>
            <div class="divFeed">
                <div class="divCounselorFeed">
                    <?php
                    $feedArea->render();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <style>
        .h3-CounselorFeed {
            text-align: center;
        }

        .divFeed {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
        }

        .divCounselorFeed {
            width: 65%;
            height: 100%;
            display: flex;
            justify-content: center;
        }

        .main-grid {}

        .main-grid .left {
            width: 100%;
            height: 3000px;
        }

        /* .main-grid .right{
            flex-grow: 1;
            background-color: red;
            height: 50vh;
        } */
    </style>

</div>
