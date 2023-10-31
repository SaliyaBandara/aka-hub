<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar();
$calendar = new Calendar();
$reservationTable = new reservationTable();
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
        <div class="details">
            <div class="card">
                <div class="cardText">
                    <h1 class="h2">View Request</h1>
                    <div class="d1">Student Name: Kasun udara</div>
                    <div class="d1">Email: 2021CS198@.stu.cmb.ac.lk</div>
                    <div class="d1">Reservation Date: 2023/10/30</div>
                    <div class="d1">Reservation Time: 15:00</div>
                    <div class="d1">
                        <button class="button primary">Accept</button>
                        <button class="button primary">Decline</button>
                    </div>
                    
                </div>
            </div>
        </div>
    
    </div>

    <style>
        .h2 {
        color: #222f3e;
        font-size: 24px;
        font-weight: bold;
        }

        .cardImage {
        border-radius: 10px 10px 0 0;
        }

        .cardText {
        padding: 10px 30px 20px;
        }


        .d1 {
        color: #576574;
        font-size: 18px;
        font-family: lato;
        font-weight: 300;
        max-width: 500px;
        line-height: 30px;
        }

        .button {
        border: none;
        color: white;
        font-weight: 500;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 50px; 
        background-color: #1d009b;  
        }

        .button:hover {
        background-color: #1d009b;
        transition: 0.5s;
        }

        /* Purple */
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
