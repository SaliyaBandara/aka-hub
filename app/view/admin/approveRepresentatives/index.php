<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("approveRepresentatives");
$approveArea = new ApproveArea();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>


    <div class="main-grid flex">
        <div class="left">
            <div class="approveDivContainor">
                <?php echo $approveArea->render(); ?>
            </div>
        </div>
        <!-- <div class="right">
            
        </div> -->
    </div>

    <style>
        .approveDivContainor{
            width: 100%;
            height: auto;
        }
        .approveDivContainor h3{
            text-align: center;
        }
        .main-grid{

        }

        .main-grid .left{
            width: 100%!important;
            height: 1350px;
            padding: 0 150px 0 150px;
        }
        /* .main-grid .right{
            flex-grow: 1;
            height: 1000px;
        } */
    </style>

</div>
