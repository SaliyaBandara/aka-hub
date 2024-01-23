<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("approveTeachingStudents");
$approveArea = new TeachingStudentApproveArea();
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
            height: 500px;
        }
        .approveDivContainor h3{
            text-align: center;
        }
        .main-grid{

        }

        .main-grid .left{
            width: 100%;
            height: 1150px;
        }
        /* .main-grid .right{
            flex-grow: 1;
            height: 1000px;
        } */
    </style>

</div>
