<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar();
$candidateCard = new CandidateCard();
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
            <div class ="profileHeading">Your Profile</div>
            <div class = "profileArea">
                <div class = "profileImageArea">
                    <div class = "profileImageContainer"><img class = "profileImage" src="<?= BASE_URL ?>/public/assets/img/common/candidateImage.jpg" alt=""></img></div>
                    <div class = "editImageButton"><input type = "button" class = "profileButton" value = "Change Picture"/></div>
                </div>
                <div class = "profileDetailArea">
                    <div class = "profileDetailRow"><div class = "profileDetailHeader">Name : </div><div class = "profileDetailCell">Samudi Perera</div></div>
                    <div class = "profileDetailRow"><div class = "profileDetailHeader">Email Address : </div><div class = "profileDetailCell">2021cs1234@ucsc.cmb.ac.lk</div></div>
                    <div class = "profileDetailRow"><div class = "profileDetailHeader">Degree : </div><div class = "profileDetailCell">Computer Science</div></div>
                    <div class = "profileDetailRow"><div class = "profileDetailHeader">Index Number : </div><div class = "profileDetailCell">21001234</div></div>
                    <div class = "profileDetailRow"><div class = "profileDetailHeader">Alternative Email : </div><div class = "profileDetailCell">Samudi@gmail.com</div></div>
                </div>
            </div>
            <hr></hr>
            <div class ="notificationHeading">Notification Settings</div>
            <div class = "notificationDetailArea">
                <div class = "notificationHeaders">
                    <div class ="notificationHeader">Preferred Email Address to receive Notifications</div>
                    <div class ="notificationHeader">Send Exam and Assignment Notifications</div>
                    <div class ="notificationHeader">Send Reminder Notifications through</div>
                    <div class ="notificationHeader">Send Reminder Notifications (No. of days before) </div>
                    <div class ="notificationHeader">Send New Club Event Post Notifications</div>
                    <div class ="notificationHeader">Send New Material update Notifications</div>
                </div>
                <div class = "notificationInputs"></div>
            </div>
        </div>
    </div>

    <style>
        .main-grid {}

        .main-grid .left {
            width: 100%;
            height: 100vh;
            margin: 20px;
        }

        .profileHeading {
            margin-left : 20px;
            font-weight : bold;
        }

        .notificationHeading{
            margin-top : 20px;
            margin-left : 20px;
            font-weight : bold;
        }

        .profileImage{
            border-radius: 100px;
            width: 200px;
            height: 200px;
            /* margin-left: 20px; */
            margin: 0 auto;
            margin-bottom: 20px;
            border : 5px solid rgba(38,132,255, 0.5)
        }

        .profileArea, .notificationDetailArea {
            display : flex;
            height : 45%;
        }

        .profileDetailArea{
            width : 65%;
            padding-top: 70px;
            
        }

        .profileImageArea{
            width : 35%;
            margin : 1%;
            padding : 4%;

        }

        .profileButton{
            border-radius: 20px;
            background: #2684FF;
            color: white;
            border: none;
            font-size: 12px;
            width: 120px;
            height: 21px;
            margin: 0 auto;
            margin-left : 30%;
        }

        .profileButton:hover {
            cursor: pointer;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);

        }

        .profileDetailRow{
            display : flex;
            margin-top : 2%;
        }

        .profileDetailCell{
            justify-content: flex-start;
            margin-left : 5%;
        }

        .profileDetailHeader{
            width:25%;
        }

        .notificationHeaders{
            padding-left : 30px;
            margin-top : 30px;
            width: 50%
        }

        .notificationHeader{
            margin: 2%;
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