<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar();
$calendar = new Calendar();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left">
            <!-- <div class="threeCardDiv">
                <div class="cardTotalUsers">
                    <div class="divUsersContainor">
                        5 Accepted Reservations in this week
                    </div>
                </div>
                <div class="cardActiveUsers">
                    <div class="divUsersContainor">
                        2 Free Time Slots in this week
                    </div>
                </div>
                <div class="cardNewUsers">
                    <div class="divUsersContainor">
                        8 Total Requests in this week
                    </div>
                </div>
            </div> -->
            <!-- <div class="calendarContainor">
                <?php echo $calendar->render(); ?>
            </div> -->

             <!-- ===VIRAJITH=== -->

            <div class="main-div">
                <div class="header-topic">
                    <h1>Manage Time Slots</h1>
                </div>
                <div class="date-range">
                    <p class="p2">From<input type="date"> to <input type="date"><a href="google.com" class="button-select">Show</a></p>
                    <p class="p1">Please add your available time slots here</p>
                </div>
                <div class="custom-button-div">
                    <a href="#" class="button-custom">Create a Custom time slot</a>
                </div>
                <div class="wrapper">    
                    <div class="card card-not-added" >
                            <div class="content">
                                <div class="details">
                                    <i class='bx bxs-time'></i>
                                    <span class="name">8am - 10am</span>
                                </div>
                            </div>
                            <div class="buttons">
                                <a href="google.com" class="button-add">Add</a>
                                <a href="google.com" class="button-delete">Delete</a>
                            </div>   
                    </div>
                    <div class="card card-added" >
                            <div class="content">
                                <div class="details">
                                    <i class='bx bxs-time'></i>
                                    <span class="name">10am - 12pm</span>
                                </div>
                            </div>
                            <div class="buttons">
                                <a href="google.com" class="button-remove">Remove</a>
                                <a href="google.com" class="button-delete">Delete</a>
                            </div>   
                    </div>
                    <div class="card card-not-added" >
                            <div class="content">
                                <div class="details">
                                    <i class='bx bxs-time'></i>
                                    <span class="name">12pm - 01pm</span>
                                </div>
                            </div>
                            <div class="buttons">
                                <a href="google.com" class="button-add">Add</a>
                                <a href="google.com" class="button-delete">Delete</a>
                            </div>   
                    </div>
                    <div class="card card-not-added" >
                            <div class="content">
                                <div class="details">
                                    <i class='bx bxs-time'></i>
                                    <span class="name">01pm - 03pm</span>
                                </div>
                            </div>
                            <div class="buttons">
                                <a href="google.com" class="button-add">Add</a>
                                <a href="google.com" class="button-delete">Delete</a>
                            </div>   
                    </div>
                    <div class="card card-not-added" >
                            <div class="content">
                                <div class="details">
                                    <i class='bx bxs-time'></i>
                                    <span class="name">03pm - 05pm</span>
                                </div>
                            </div>
                            <div class="buttons">
                                <a href="google.com" class="button-add">Add</a>
                                <a href="google.com" class="button-delete">Delete</a>
                            </div>   
                    </div>
                </div>
                <!-- <div>
                    <a href="google.com" class="button-custom">Create</a>
                </div> -->
            </div> 
        </div>
        <div class="right">
            
        </div>
    </div>

    <style>
        .main-grid .left {
            width: 75%;
            height: 150vh;

        }

        .main-grid .right {
            flex-grow: 1;
            height: 150vh;
        }

        .threeCardDiv {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            height: 175px;
            width: 100%;
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
            margin-left: 50px;
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

    </style>

    <style>
        .main-div{
            
        }
        .wrapper{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            /* z-index: +5; */
            margin-top: -200px;
        }

        .wrapper .card{
           
            width: 80%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            position:relative;
            margin-bottom: 20px;
            border-radius: 20px 20px 20px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .card-not-added{
            background: #eeecec;
        }
        .card-added{
            background: #ff9b2d;
        }
        .card .content{
            display: flex;
            align-items: center;

        }

        .card .details {
            margin-left: 80px;
        }

        .details span{
            font-weight: 600;
            font-size: 18px;
        }
        .details i{
            margin-right: 30px;
            margin-left: -50px;
            font-size: 24px;
        }
        .card a{
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 25px;
            color: #fff;
            /* background: linear-gradient(to bottom, #bea2e7 0%, #86b7e7 100%); */
        }

        .date-range{
            text-align: center;
        }
        .date-range input{
            margin-right: 10px;
            margin-left: 10px;
            width: 20%;
            padding: 8px;
            border-radius: 8px;
            border-style: groove;
            background-color: #fff;
        }
        .button-add{
            background: #2684FF;
            width: 100px;
            text-align: center;
        }
        .button-delete{
            background: red;
            width: 100px;
            text-align: center;
        }
        .button-remove{
            background: #2684FF;
            width: 100px;
            text-align: center;
        }
        .header-topic{
            text-align: center;
        }
        .button-select{
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 25px;
            color: #fff;
            background: #2684FF;
        }
        .p1{
            font-size: 20px;
            font-weight: 700;
        }
        .p2{
            font-size: 18px;
            font-weight: 700;
        }
        .button-custom{
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 25px;
            color: #fff;
            background: #2684FF;
            align-items: center;
        }
        .custom-button-div{
            margin-bottom:40px;
            text-align: center;
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