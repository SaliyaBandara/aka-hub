<?php
class UserDetailsCard
{
    public function render()
    {

?>
        <div class="user-card">
            <div class="user-card-div">
                <div id="userName">
                    Binura
                </div>
                <div id="userMail">
                    2021CS198@.stu.cmb.ac.lk
                </div>
                <div id= "userIndex">
                    21001987
                </div>
                <div id= "userRole">
                    Student Rep
                </div>
            </div>
        </div>
        <style>
            #userName {
                width: 25%;
                height: 20%;
            }
            #userMail {
                width: 25%;
                height: 20%;
            }
            #userIndex {
                width: 25%;
                height: 20%;
            }

            #userRole {
                width: 25%;
                height: 20%;
            }
            .user-card{
                background-color: white;
                width: 100%;
                height: 75px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                justify-content: space-between;
                align-items: center;    
                margin: 10px 0 10px 3px;
                display: flex;
            }

            .user-card-div {
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