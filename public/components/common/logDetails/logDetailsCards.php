<?php
class LogDetailsCards
{
    public function render()
    {

?>
        <div class="approve-card">
            <div class="approve-card-div">
                <div id="logID" class="tableHeaderItem">
                    lid01
                </div>
                <div id="indexNumber" class="tableHeaderItem">
                    21001987
                </div>
                <div id= "ipAddress" class="tableHeaderItem">
                    192.168.1.1
                </div>
                <div id= "Details" class="tableHeaderItem">
                    Student Rep
                </div>
                <div id= "Date" class="tableHeaderItem">
                    2023/10/27
                </div>
                <div id= "Time" class="tableHeaderItem">
                    4.12PM
                </div>
            </div>
        </div>
        <style>
            #logID{
                width: 16.67%;
                height: 15%;
                color:black;
            }
            #indexNumber{
                width: 16.67%;
                height: 20%;
                color:black;
            }
            #ipAddress{
                width: 16.67%;
                height: 20%;
                color:black;
            }
            #Details{
                width: 16.67%;
                height: 20%;
                color:black;
            }
            #Date{
                width: 16.67%;
                height: 20%;
                color:black;
            }
            #Time{
                width: 16.67%;
                height: 20%;
                color:black;
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