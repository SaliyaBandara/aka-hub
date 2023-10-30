<?php

class LogDetailsArea
{

    public function render()
    {
        $logDetailsCard = new LogDetailsCards();
?> <div class="containorForcardArea">
            <div class="tableContainor">
                <div class="cardContainor">
                <h3 class="h3-RepApprove">Log Entries</h3>
                    <div class="searchBarContainor">
                        <label>Search</label>
                        <div class="searchBar">
                            <input class="searchText" type="text" name="search" id="search">
                        </div>
                    </div>
                    <div class="div-tableHeader">
                        <div id="nameHeader" class="tableHeaderItem">
                            LogID
                        </div>
                        <div id="mailHeader" class="tableHeaderItem">
                            UserID
                        </div>
                        <div id="indexNumberHeader" class="tableHeaderItem">
                            IP address
                        </div>
                        <div id="roleHeader" class="tableHeaderItem">
                            Details
                        </div>
                        <div id="roleHeader" class="tableHeaderItem">
                            Date
                        </div>
                        <div id="roleHeader" class="tableHeaderItem">
                            Time
                        </div>
                    </div>
                    <?php echo $logDetailsCard->render(); ?>
                    <?php echo $logDetailsCard->render(); ?>
                    <?php echo $logDetailsCard->render(); ?>
                    <?php echo $logDetailsCard->render(); ?>
                    <?php echo $logDetailsCard->render(); ?>
                    <?php echo $logDetailsCard->render(); ?>
                    <?php echo $logDetailsCard->render(); ?>
                    <?php echo $logDetailsCard->render(); ?>
                    <?php echo $logDetailsCard->render(); ?>
                    <?php echo $logDetailsCard->render(); ?>
                </div>
            </div>

        </div>

        <style>

            .h3-RepApprove{
                text-align: center;
                margin-bottom: 20px;
                width: 90%;
            }
            .tableHeaderItem{
                width: 16.67%;
                height: 65px;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .tableContainor {
                width: 90%;
                height: 90%;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
                margin-top: 50px;
            }

            .searchText {
                width: 100%;
                height: 100%;
                border: none;
                outline: none;
                border-radius: 10px;
                padding: 1rem 1.25rem;
                font-size: 0.6rem;
                font-weight: 500;
                background-color: #f1f1f1;
            }

            .searchBar {
                height: 30px;
                margin-left: 5px;
            }

            .searchBarContainor {
                width: 100%;
                height: 30px;
                display: flex;
                justify-content: flex-end;
                align-items: center;
                margin-bottom: 15px;
                padding-right: 95px;
            }

            .div-tableHeader {
                width: 90.5%;
                height: 65px;
                background-color: #2684FF;
                opacity: 1;
                display: flex;
            }

            .cardContainor {
                width: 100%;
                height: 100%;
                margin: 50px 0 50px 0;
                padding-left: 100px;
                justify-content: center;
                align-items: center;
            }

            .containorForcardArea {
                display: flex;
                width: 100%;
                justify-content: center;
                align-items: center;
            }

            .notificationContainor h3 {
                text-align: center;
                width: 92%;
            }
        </style>

        <script>

        </script>

<?php

    }
}
