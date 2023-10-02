<?php

class ApproveArea
{

    public function render()
    {
        $approveCard = new ApproveCards();
?> <div class="containorForcardArea">
            <div class="tableContainor">
                <div class="cardContainor">
                    <div class="searchBarContainor">
                        <label>Search</label>
                        <div class="searchBar">
                            <input class="searchText" type="text" name="search" id="search">
                        </div>
                    </div>
                    <div class="div-tableHeader">
                        <div class="tableHeaderItem">
                            Student Name
                        </div>
                        <div class="tableHeaderItem">
                            University Email
                        </div>
                        <div class="tableHeaderItem">
                            Index Number
                        </div>
                        <div class="tableHeaderItem">
                            Rep Type
                        </div>
                        <div class="tableHeaderItem">
                            Action
                        </div>
                    </div>
                    <?php echo $approveCard->render(); ?>
                    <?php echo $approveCard->render(); ?>
                    <?php echo $approveCard->render(); ?>
                    <?php echo $approveCard->render(); ?>
                    <?php echo $approveCard->render(); ?>
                    <?php echo $approveCard->render(); ?>
                    <?php echo $approveCard->render(); ?>
                    <?php echo $approveCard->render(); ?>
                    <?php echo $approveCard->render(); ?>
                    <?php echo $approveCard->render(); ?>
                </div>
            </div>

        </div>

        <style>
            .tableContainor{
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
            }

            .searchBar {
                border: 1px solid #2684FF;
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

            .tableHeaderItem {
                width: 20%;
                height: 65px;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .div-tableHeader {
                width: 90.5%;
                height: 65px;
                background-color: #2684FF;
                opacity: 0.5;
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
