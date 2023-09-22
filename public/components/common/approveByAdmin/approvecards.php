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
                <div class="repAccept">
                    <img src="https://cdn0.iconfinder.com/data/icons/play-music-line-blue/128/check_blue-512.png" alt="">
                </div>
                <div class="repDecline">
                    <img src="<?= BASE_URL ?>/public/assets/img/icons/rejected.png" alt="">
                    <!-- <img src="https://cdn-icons-png.flaticon.com/512/5508/5508714.png" alt=""> -->
                </div>
            </div>
        </div>
        <style>
            #repName {
                width: 25%;
                height: 20%;
            }
            #repMail {
                width: 25%;
                height: 20%;
            }
            #repIndex {
                width: 25%;
                height: 20%;
            }
            .repAccept{
                width: 12%;
                height: 65px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            .repDecline{
                width: 12%;
                height:38px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .repAccept img{
                width: 65px;
                height: 65px;
            }   
            .repDecline img{
                width: 35px;
                height: 35px;
            }
            .repAccept img:hover{
                width: 67px;
                height: 67px;
                cursor: pointer;
            }
            .repDecline img:hover{
                width: 37px;
                height: 37px;
                cursor: pointer;
            }
            .approve-card {
                background-color: white;
                width: 90%;
                height: 75px;
                border-radius: 5px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
                justify-content: space-between;
                align-items: center;
                
                margin: 10px 0 10px 3px;
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