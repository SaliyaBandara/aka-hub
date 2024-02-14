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

            <!-- ===VIRAJITH=== -->
            <div class="wrapper">
                <section class="users">
                    <header>
                        <div class="content">
                            <img src="https://pbs.twimg.com/media/FjU2lkcWYAgNG6d.jpg" alt="">
                            <div class="details">
                                <span>Virajith Dissanayaka</span>
                                <p>Active now</p>
                            </div>
                        </div>
                        <a href="#" class="logout">Logout</a>
                    </header>
                    <div class="search">
                        <span class="text">Select an user to start chat</span>
                        <input type="text" placeholder="Enter name to search...">
                        <button><i class='bx bx-search-alt-2'></i></button>
                    </div>
                    <div class="users-list">
                        <a href="#">
                            <div class="content">
                                <img src="https://pbs.twimg.com/media/FjU2lkcWYAgNG6d.jpg" alt="">
                                <div class="details">
                                    <span>Virajith Dissanayaka</span>
                                    <p>This is test message</p>
                                </div>
                            </div>
                            <div class="status-dot"><i class="fas fa-circle"></i></div>
                        </a>
                    </div>
                </section>
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
        .wrapper{
            background: #fff;
            width: 650px;
            border-radius: 16px;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
                        0 32px 64px -48px rgba(0, 0, 0, 0.5);
            z-index: 10000;            
        }
        /* Users area CSS */
        .users{
            padding: 25px 30px;
        }
        .users header,
        .users-list a{
            display: flex;
            align-items: center;
            padding-bottom: 20px;
            justify-content: space-between;
            border-bottom: 1px solid #e6e6e6;
        }
        .wrapper img{
            object-fit: cover;
            border-radius: 50%;
        }
        :is(.users, .users-list) .content{
            display: flex;
            align-items: center;
        }
        .users header .content img{
            height:50px;
            width:50px;
        }
        :is(.users, .users-list) .details{
            color: #000;
            margin-left: 15px;
        }
        :is(.users, .users-list) .details span{
            font-size: 18px;
            font-weight: 500;
        }
        .users header .logout{
            color:#fff;
            font-size: 17px;
            padding: 7px 15px;
            background: #333;
            border-radius: 5px;
            text-decoration: none;
            /* margin-left: 1000px; */
        }
        .users .search{
            margin: 20px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .users .search{
            margin: 20px 0;
            display: flex;
            position: relative;
            align-items: center;
            justify-content: space-between;
        }
        .users .search .text{
            font-size: 18px;
        }
        .users .search input{
            position:absolute;
            height: 42px;
            width: calc(100% - 50px);
            border: 1px solid #ccc;
            padding: 0 13px;
            font-size: 16px;
            border-radius: 5px;
            outline: none;
        }
        .users .search button{
            width: 47px;
            height: 42px;
            border: none;
            outline: none;
            color: #fff;
            background: #333;
            cursor: pointer;
            font-size: 17px;
            border-radius: 0 5px 5px 0;
        }
        .users-list{

        }
        .users-list a .content img{
            height: 40px;
            width: 40px;
        }
    </style>

    

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
