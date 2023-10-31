<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("reservationRequests");
$calendar = new Calendar();
// $reservationTable = new reservationTable();
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Saliya", "Bandara"); ?>
    <div class="main-grid flex">
        <div class="left">
            <div class="threeCardDiv">
                <div class="cardTotalUsers">
                    <div class="divUsersContainor">
                        6 Received Requests in this Week
                    </div>
                </div>
                <div class="cardActiveUsers">
                    <div class="divUsersContainor">
                        2 Free Time Slots in this week
                    </div>
                </div>
                <div class="cardNewUsers">
                    <div class="divUsersContainor">
                        2 Accepted Reservations in this Week
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .iconModule{
            width: 50px;
            height: 50px;
            background-color: #bdd2f1;
        }
        .divActiveCoursesHeaderPart {
            width: 30%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .divActiveCoursesHeader {
            width: 100%;
            height: 50px;
            display: flex;
            justify-content : space-evenly;
            padding-top: 15px;
        }

        .divActiveCoursesHeader select{
            height : 20px;;
            font-size : 14px;
            border : none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);

        }

        .todo_flex_wrap {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
        }

        .todo_item {
            text-decoration: none;
            color: initial;

            width: 31%;
            min-width: 1000px;
            padding: 1rem;
            margin: 1rem;
            margin-left: 0;
            margin-top: 0;
            border-radius: 10px;
            border: 1px solid #d0d0d0;
            /* background-color: #f5f5f5; */

            transition: all 0.3s ease-in-out;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .todo_item:hover {
            transform: scale(1.025);
            background-color: #f5f5f5;
            background-color: #eeecec;
            background-color: #bdd2f138;
        }

        .todo_item .todo_item_date {
            width: 4.5rem;
            height: 4.5rem;
            border-radius: 50%;
            border: 5px solid #bdd2f1;
            font-size: 2rem;
            font-weight: 500;
        }

        .todo_item .todo_item_text {
            margin-left: 1.5rem;
        }

        .todo_item .todo_item_text>div {
            margin-bottom: 0.25rem;
        }

        .profileButton{
            width: 100px;
            height: 20px;
            background-color: #2684FF;
            border-radius: 5px;
            color: white;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            border : none;
            font-size : 14px;

        }

        .profileButton:hover {
            cursor: pointer;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }


    </style>

    
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

        .approveDivContainor {
            width: 100%;
            height: 500px;
        }

        .approveDivContainor h3 {
            text-align: center;
        }

        .main-grid {}

        .main-grid .left {
            width: 100%;
            height: 1150px;
        }

        /* .main-grid .right{
            flex-grow: 1;
            height: 1000px;
        } */
    </style>

    <style>
        .main-grid {}

        .main-grid .left {
            width: 100%;
            /* background-color: yellowgreen; */
            height: 150vh;
            padding: 2rem;
        }

        .main-grid .right {
            flex-grow: 1;
            background-color: yellowgreen;
            height: 150vh;
        }

        .onsite_alert {
            text-decoration: none;
            width: 100%;
            padding: 0.75rem 1rem;
            padding-right: 0;
            background-color: #e5f9e5;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .onsite_alert .close_btn {
            margin-left: auto;
            cursor: pointer;
            font-size: var(--rv-1-25);
            padding: 0 1rem;
        }

        .onsite_alert .close_btn:hover {
            color: red;
        }

        .onsite_alert.alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>

</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
