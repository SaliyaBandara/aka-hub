<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("counselorReservations");
$calendar = new Calendar();
$reservationTable = new reservationTable();
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Saliya", "Bandara"); ?>

    <div class="main-grid flex">
        <div class="left">
            <div class="details">
                <div class="card">
                    <div class="cardText">
                        <h1 class="h2">Reservation Details</h1>
                        <div class="d1">Student Name: Kasun udara</div>
                        <div class="d1">Email: 2021CS198@.stu.cmb.ac.lk</div>
                        <div class="d1">Reservation Date: 2023/10/30</div>
                        <div class="d1">Reservation Time: 15:00</div>
                        <button class="button primary">Session Completed</button>
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
</div>