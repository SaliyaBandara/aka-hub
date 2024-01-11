<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("viewUserDistribution");
$userDetailsArea = new UserDetailsArea();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>


    <div class="main-grid flex">
        <div class="leftViewUserDistribution">
            <div class="approveDivContainor">
                <?php echo $userDetailsArea->render(); ?>
            </div>
        </div>
        <!-- <div class="right">
            
        </div> -->
    </div>

    <style>
        .approveDivContainor {
            width: 100%;
            height: 500px;
        }

        .approveDivContainor h3 {
            text-align: center;
        }

        .main-grid {}

        .main-grid .leftViewUserDistribution {
            width: 100%;
            height: 850px;
            padding: 0 140px 0 140px;
        }

        /* .main-grid .right{
            flex-grow: 1;
            height: 1000px;
        } */
    </style>

</div>
