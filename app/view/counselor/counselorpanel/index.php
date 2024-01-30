<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("counselorPanel");
$calendar = new Calendar();
?>
<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left">
            <div class="threeCardDiv">
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
            </div>

            <!-- ===VIRAJITH=== -->

            <div class="sub-container">
                <div class="notification-container">
                    <!-- <div class="card-container">
                        <div class="card">Card 1</div>
                        <div class="card">Card 2</div>
                        <div class="card">Card 3</div>
                    </div> -->

                    <div class="container1">
                        <header>
                            <div class="notif_box">
                                <h2 class="title"><i class='bx bxs-bell-ring' ></i> Notifications</h2>
                                <span id="notifications"></span>
                            </div>
                            <p id="mark_all">Mark All has Read</p>
                        </header>
                        <main>
                            <div class="notif_card unread">
                                <img src="https://static.vecteezy.com/system/resources/previews/005/269/576/non_2x/mail-icon-free-vector.jpg" alt="avatar">
                                <div class="description">
                                    <p class="user_activity">
                                        <strong>Mark Webber</strong> reacted to your recent post <b>My first tournement today!</b>
                                    </p>
                                    <p class="time">1m ago</p>

                                </div>
                            </div>
                            <div class="notif_card unread">
                                <img src="https://static.vecteezy.com/system/resources/previews/005/269/576/non_2x/mail-icon-free-vector.jpg" alt="avatar">
                                <div class="description">
                                    <p class="user_activity">
                                        <strong>Mark Webber</strong> reacted to your recent post <b>My first tournement today!</b>
                                    </p>
                                    <p class="time">1m ago</p>
                                    
                                </div>
                            </div>
                            <div class="notif_card unread">
                                <img src="https://static.vecteezy.com/system/resources/previews/005/269/576/non_2x/mail-icon-free-vector.jpg" alt="avatar">
                                <div class="description">
                                    <p class="user_activity">
                                        <strong>Mark Webber</strong> reacted to your recent post <b>My first tournement today!</b>
                                    </p>
                                    <p class="time">1m ago</p>
                                    
                                </div>
                            </div>
                            <div class="notif_card">
                                <div class="message_card">
                                    <img src="https://static.vecteezy.com/system/resources/previews/005/269/576/non_2x/mail-icon-free-vector.jpg" alt="avatar">
                                    <div class="description">
                                        <p class="user_activity">
                                            <strong>Kasun Karunanayake</strong> sent you a private message
                                        </p>
                                        <p class="time">1 Day ago</p>
                                    </div>
                                </div>
                            </div>
                            <div class="message">
                                <p>
                                    Hello, thank you for settingup chess club. i've been a member for a few weeks now and
                                    I'm already having lots of fun and improving my game.
                                </p>
                            </div>
                            <div class="notif_card">
                                <img src="https://static.vecteezy.com/system/resources/previews/005/269/576/non_2x/mail-icon-free-vector.jpg" alt="avatar">
                                <div class="description">
                                    <p class="user_activity">
                                        <strong>Virajith dissanayaka</strong> commented on your picture
                                    </p>
                                    <p class="time">1 week ago</p>
                                    <img src="https://static.vecteezy.com/system/resources/previews/005/269/576/non_2x/mail-icon-free-vector.jpg" class="chess_img" alt="chess">
                                </div>
                            </div>
                            <div class="notif_card">
                                <img src="https://static.vecteezy.com/system/resources/previews/005/269/576/non_2x/mail-icon-free-vector.jpg" alt="avatar">
                                <div class="description">
                                    <p class="user_activity">
                                        <strong>Kasun Udara</strong> reacted to your post
                                    </p>
                                    <p class="time">2 weeks ago</p>
                                </div>
                            </div>
                            <div class="notif_card">
                                <img src="https://static.vecteezy.com/system/resources/previews/005/269/576/non_2x/mail-icon-free-vector.jpg" alt="avatar">
                                <div class="description">
                                    <p class="user_activity">
                                        <strong>Samudi perera</strong> left the chess group
                                    </p>
                                    <p class="time">2 weeks ago</p>
                                </div>
                            </div>
                        </main>
                    </div>

                </div>
                <div class="calendarContainor">
                    <?php echo $calendar->render(); ?>
                </div>
            </div>
            
            
        </div>
        <div class="right">
            <!-- <div class="calendarContainor">
                <?php echo $calendar->render(); ?>
            </div> -->
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

        .card-container {
            display: flex;
            flex-direction: column; /* Display cards vertically */
        }

        .card {
            width: 100%; /* Make cards take full width */
            height: 150px;
            width: 550px;
            margin-left: 90px;
            margin-right: 150px;
            background-color: #f0f0f0;
            margin-bottom: 20px; /* Increase vertical space between cards */
            padding: 20px;
            box-sizing: border-box;
        }

        .sub-container{
            display: flex;
            flex-direction: row; 
        }
    </style>

    <style>
        .container1{
            margin: 2rem;
            width: 70%;
            background-color: #f0f0f0;
            padding: 1.5rem 1rem;
            border-radius:  40px;
            margin-left: 50px;
            /* margin-right: -50; */
        }
        header{
            display:flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
        .notif_box{
            display:flex;
            align-items: center;
        }
        #notifications{
            background-color: #2684FF;
            margin-left: 0.5rem;
            width: 35pxr;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 30px;
            color:#f0f0f0;
            font-weight: 800;
            border-radius: .5rem;
        }
        #mark_all{
            cursor: pointer;
        }
        #mark_all:hover{
            color:#2684FF;
        }
        p{
            color: var(--dark-grayish-blue);
        }
        main{
            display:flex;
            flex-direction: column;
            gap: 1rem;
        }
        .notif_card{
            display:flex;
            align-items: center;
            border-radius:  .5rem;
            padding: 1rem;
        }
        img{
            width: 50px;
        }
        .description{
            margin-left: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        strong{
            color: var(--Vary-dark-blue);
            cursor: pointer; 
        }
        strong:hover{
            color:#2684FF;
        }
        .unread{
            background-color: var(--Light-grayish-blue-1) !important; 
        }
        .unread p:first-of-type::after{
            content: "";
            background-color: var(--Red);
            width: 10px;
            height:10px;
            display: inline-block;
            border-radius: 50%;
        }
     
    </style>

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
