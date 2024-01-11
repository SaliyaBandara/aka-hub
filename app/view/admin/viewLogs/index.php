<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("viewlogs");
$logDetailsArea = new LogDetailsArea();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>


    <div class="main-grid flex">
        <div class="leftApprove">
            <div class="approveDivContainor">
                <?php echo $logDetailsArea->render(); ?>
            </div>
        </div>
        <!-- <div class="right">
            
        </div> -->
    </div>

    <style>
        .approveDivContainor {
            width: 100%;
            height: auto;
            padding: 31px;
        }

        .approveDivContainor h3 {
            text-align: center;
        }

        .main-grid .leftApprove {
            width: 100%;
            height: auto;
        }

        /* .main-grid .right{
            flex-grow: 1;
            height: 1000px;
        } */
    </style>

</div>
