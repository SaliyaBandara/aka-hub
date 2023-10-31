<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar();
// $calendar = new Calendar();
// $reservationTable = new reservationTable();
?>

<div id="sidebar-active">

    <div class="welcome-back">
        <div class="flex flex_container">
            <div class="flex_item">
                <div class="title pb-0-5">Welcome back</div>
                <div class="text-muted">Dr. Kasun Karunanayake</div>
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
                <!-- <div class="text-muted">Hi Kasun Udara</div> -->
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
            <div class="threeCardDiv">
                <div class="cardTotalUsers">
                    <div class="divUsersContainor">
                        6 Received Requests in this Week
                    </div> 
                </div>
                <div class="cardActiveUsers">
                    <div class="divUsersContainor">
                        2 Free Time  Slots in this week
                    </div>
                </div>
                <div class="cardNewUsers">
                    <div class="divUsersContainor">
                        2 Accepted Reservations in this Week
                    </div>
                </div>
            </div>
            <div>
                <!-- todo flex wrap -->
                <div class="todo_flex_wrap flex flex-wrap">
                    <a href="#" class="todo_item flex align-center">
                        <div class="iconModule">

                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">New Request</div>
                            <div class="font-1 font-medium text-muted">From Binura Hasarindu</div>
                            <button>View</button>
                        </div>
                    </a>
                    <a href="#" class="todo_item flex align-center">
                        <div class="iconModule">

                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">New Request</div>
                            <div class="font-1 font-medium text-muted">From Binura Hasarindu</div>
                            <button>View</button>
                        </div>
                    </a>
                    <a href="#" class="todo_item flex align-center">
                        <div class="iconModule">

                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">New Request</div>
                            <div class="font-1 font-medium text-muted">From Binura Hasarindu</div>
                            <button>View</button>
                        </div>
                    </a>
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