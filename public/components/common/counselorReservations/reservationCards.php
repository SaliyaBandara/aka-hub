<?php
class ReservationCards
{
    public function render()
    {

?>
        <div class="reservation-card">
            <div class="reservation-card-div">
                <div id="resDate">
                    2023/10/30
                </div>
                <div id="resTime">
                    15:00
                </div>
                <div id= "stuName">
                    Kasun Udara
                </div>
                <div id= "stuEmail">
                    2021CS198@.stu.cmb.ac.lk
                </div>
                <div class="resDetails">
                    <div class="detailsButton">Details</div>
                </div>
                
            </div>
        </div>
        <style>
            .detailsButton{
                border: 1px solid #ff9b2d;
                width: 65%;
                height: 55%;
                display:flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0px 0px 5px 0px #2684FF;
            }
            .detailsButton:hover{
                background-color: #ff9b2d;
                opacity:1;
                cursor: pointer;
                color: white;
                font-size: 17.5px;
            }
            #resDate {
                width: 15%;
                height: 20%;
            }
            #resTime {
                width: 15%;
                height: 20%;
            }
            #stuName {
                width: 15%;
                height: 20%;
            }
            #stuEmail {
                width: 25%;
                height: 20%;
            }
            .resDetails{
                width: 15%;
                height: 65px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
           
            .reservation-card {
                background-color: white;
                width: 90%;
                height: 65px;
                justify-content: space-between;
                align-items: center;
                margin: 0px 0 0 3px;
                display: flex;
            }

            .reservation-card-div {
                text-align: center;
                align-items: center;
                display: flex;
                width: 100%;
            }
        </style>

        <script>

        </script>

<?php

    }
}