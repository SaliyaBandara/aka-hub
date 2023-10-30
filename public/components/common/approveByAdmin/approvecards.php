<?php
class ApproveCards
{
    public function render()
    {

?>
        <div class="approve-card">
            <div class="approve-card-div">
                <div id="repName">
                    Binura
                </div>
                <div id="repMail">
                    2021CS198@.stu.cmb.ac.lk
                </div>
                <div id= "repIndex">
                    21001987
                </div>
                <div id= "repType">
                    Student Rep
                </div>
                <div class="repAccept">
                    <!-- <img class="acceptIcon" src="https://cdn0.iconfinder.com/data/icons/play-music-line-blue/128/check_blue-512.png" alt=""> -->
                    <div class="acceptButton">Accept</div>
                </div>
                <div class="repDecline">
                    <div class="declineButton">Decline</div>
                    <!-- <img class="declineIcon" src="<?= BASE_URL ?>/public/assets/img/icons/rejected.png" alt=""> -->
                    <!-- <img src="https://cdn-icons-png.flaticon.com/512/5508/5508714.png" alt=""> -->
                </div>
            </div>
        </div>
        <style>
            .acceptButton{
                border: 1px solid #2684FF;
                width: 75%;
                height: 55%;
                display:flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0px 0px 5px 0px #2684FF;
            }
            .declineButton{
                border: 1px solid #ff9b2d;
                width: 75%;
                height: 100%;
                display:flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0px 0px 5px 0px #ff9b2d;
            }
            .acceptButton:hover{
                background-color: #2684FF;
                opacity:1;
                cursor: pointer;
                color: white;
                font-size: 17.5px;
            }
            .declineButton:hover{
                background-color: #ff9b2d;
                opacity:1;
                cursor: pointer;
                color: white;
                font-size: 17.5px;
            }
            #repName {
                width: 15%;
                height: 20%;
            }
            #repMail {
                width: 25%;
                height: 20%;
            }
            #repIndex {
                width: 15%;
                height: 20%;
            }
            #repType {
                width: 15%;
                height: 20%;
            }
            .repAccept{
                width: 15%;
                height: 65px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            .repDecline{
                width: 15%;
                height:38px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .acceptIcon{
                width: 65px;
                height: 65px;
            }   
            .declineIcon{
                width: 35px;
                height: 35px;
            }
            .acceptIcon:hover{
                width: 67px;
                height: 67px;
                cursor: pointer;
            }
            .declineIcon:hover{
                width: 37px;
                height: 37px;
                cursor: pointer;
            }
            .approve-card {
                background-color: white;
                width: 90%;
                height: 65px;
                justify-content: space-between;
                align-items: center;
                margin: 0px 0 0 3px;
                display: flex;
            }

            .approve-card-div {
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