<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("electionDashboard");
$electionCard = new ElectionCard();
$prevElectionCard = new PrevElectionCard();
$calendar = new Calendar();
$notifications = new Notifications();

?>

<div id="sidebar-active">

    <div class="welcome-back">
        <div class="flex flex_container">
            <div class="flex_item">
                <div class="title pb-0-5">Welcome back</div>
                <div class="text-muted">Hi Samudi Perera</div>
            </div>
            <div class="flex_item search_flex">
                <form class="flex w-100" action="" method="get">
                    <button class="btn" type="submit">
                        <i class='bx bx-search'></i>
                    </button>
                    <input class="form-group" type="text" name="q" id="" placeholder="Search" />
                </form>
            </div>
            <div class="flex_item">
                <div class="title">Notifications</div>
                <div class="text-muted">Hi Samudi Perera</div>
            </div>
        </div>
    </div>

    <style>
        .welcome-back {
            width: 100%;
            padding: 0.5rem 1rem;
        }

        .welcome-back .flex_container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
        }

        .welcome-back .flex_item {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        .welcome-back .flex_item.search_flex {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 50%;
        }

        .welcome-back .flex_item.search_flex button {
            /* width: 20%; */
            padding: 1rem 1.25rem;
            padding-right: 0;
            margin: 0;

            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
            border-radius: 10px 0 0 10px;
        }

        .welcome-back .flex_item.search_flex .form-group {
            width: 80%;
            /* margin-left: 1rem; */
            border: none;
            border-radius: 0 10px 10px 0;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            font-weight: 500;
            background-color: #f5f5f5;

            outline: none;
        }

        .welcome-back .flex_item .title {
            font-size: 1.5rem;
            font-weight: 600;
        }
    </style>


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
            <div class="notificationSection">
                <?php echo $notifications->render(); ?>
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

<style>
    #sidebar-active {

        margin: 1rem 1rem 1rem calc(var(--sidebar-width-actual) + 0.75rem);
        /* background-color: yellowgreen; */
        width: (100vw - var(--sidebar-width-actual));
        /* height: 50vh; */

        /* border: 2px solid red; */


        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        overflow: hidden;
    }
</style>