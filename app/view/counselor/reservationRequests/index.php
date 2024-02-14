<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("reservationRequests");
$calendar = new Calendar();
// $reservationTable = new reservationTable();
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
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

            <!-- ===VIRAJITH=== -->

                


            <?php
                    foreach ($data["reservation_requests"] as $reservation_request) {
                    $img_src = USER_IMG_PATH . $reservation_request["cover_img"];
            ?>
                <div class="wrapper">
                            <div class="card" >
                                <div class="content">
                                    <div class="img"><img src="<?= $img_src ?>"></div>
                                    <div class="details">
                                        <span class="name"><?= $reservation_request["name"] ?></span>
                                        <p><?= $reservation_request["year"] ?> year Undergraduate</p>
                                    </div>
                                </div>
                                <a href="#divone">View</a>
                            </div>
                        </div> 
            <?php } ?>       
            </div>
            <div class="new">
                <div class="overlay" id="divone">
                    <div class="wrapper1 popup-form">
                        <h2>Reservation Details</h2>
                        <a href="" class="close">&times;</a>
                        <div class="content">
                            <div class="container">
                                <form class="form-1">
                                    <label>Name:</label>
                                    <label>Virajith Dissanayaka</label><br/>
                                    
                                    <label>Year:</label>
                                    <label>2nd year</label><br/>
                                    
                                    <input type="submit" value="Accept">
                                    <input type="submit" value="Decline">
                                </form>
                            </div>
                        </div>
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
            /* margin-bottom: -50px; */
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

    <style>
        .wrapper{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* height: 100vh;
            z-index: +5;
            margin-top: -100px; */
        }

        .wrapper .card{
            background: #eeecec;
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

        .card .content{
            display: flex;
            align-items: center;

        }

        .wrapper .card .img{
            height: 90px;
            width: 90px;
            position: absolute;
            left: 2px;
            background: #fff;
            border-radius: 50%;
            padding:5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }

        .card .img img{
            height: 100%;
            width:100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .card .details {
            margin-left: 80px;
        }

        .details span{
            font-weight: 600;
            font-size: 18px;
        }
        .card a{
            text-decoration: none;
            padding: 7px 18px;
            border-radius: 25px;
            color: #fff;
            background: linear-gradient(to bottom, #bea2e7 0%, #86b7e7 100%);
        }

    </style>
    <style>
    .overlay{
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.8);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
        z-index: 9999;
    }
    .overlay:target{
        visibility: visible;
        opacity: 1;
    }
    .wrapper1{
        margin: 70px auto;
        padding: 20px;
        background: #e7e7e7;
        border-radius: 5px;
        width: 30%;
        position: relative;
        transition: all 5s ease-in-out;
        margin-top: 300px;
        /* z-index: 9999; */
    }
    .wrapper1 h2{
        margin-top: 0;
        color: #333;
    }
    .wrapper1 .close{
        position: absolute;
        top: 20px;
        right: 30px;
        transition: all 200ms;
        font-weight: bold;
        text-decoration: none;
        color: #333;
    }
    .wrapper1 .content{
        max-height: 30%;
        overflow: auto;
    }

    /* form design */

    .container{
        border-radius: 10px;
        background-color: #e7e7e7;
        padding: 20px 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    form label{
        text-transform: uppercase;
        font-weight: 500;
        letter-spacing: 3px;
    }
    .container input[type="text"]{
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
    }
    .container input[type="submit"]{
        background-color: #2684FF;
        color: #fff;
        padding: 15px 50px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 3px;
    }
    .popup-form{
        width: 40%;
        padding: 8px;
        border-radius: 8px;
        border-style: groove;
        background-color: #fff; 
    }
    .form1 {
        align-items: center;
    }

    .form-1 {
        text-align: center;
    }

    .form-1 input[type="time"],
    .form-1 input[type="submit"] {
        margin: 0 auto; /* Center horizontally */
    }

    .wrapper1 h2{
        text-align: center;
    }
</style>

</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
