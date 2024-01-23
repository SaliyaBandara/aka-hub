<?php
class UserDetailsCards
{
    public function render()
    {

?>
        <div class="approve-card">
            <div class="approve-card-div">
                <div id="roleName">
                    Binura
                </div>
                <div id="roleMail">
                    2021CS198@.stu.cmb.ac.lk
                </div>
                <div id= "roleIndex">
                    21001987
                </div>
                <div id= "roleType">
                    Student Rep
                </div>
            </div>
        </div>
        <style>
            #roleName {
                width: 25%;
                height: 20%;
            }
            #roleMail {
                width: 25%;
                height: 20%;
            }
            #roleIndex {
                width: 25%;
                height: 20%;
            }
            #roleType {
                width: 25%;
                height: 20%;
            }
            
            .approve-card {
                background-color: white;
                width: 100%;
                height: 55px;
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