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
                        <div id="nameHeader" class="tableHeaderItem">
                            Student Name
                        </div>
                        <div id="mailHeader" class="tableHeaderItem">
                            University Email
                        </div>
                        <div id="indexNumberHeader" class="tableHeaderItem">
                            Index Number
                        </div>
                        <div id="repTypeHeader" class="tableHeaderItem">
                            Rep Type
                        </div>
                        <div id="actionHeader" class="tableHeaderItem">
                            Action to Perform
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
            #nameHeader {
                width: 15%;
                height: 65px;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #mailHeader {
                width: 25%;
                height: 65px;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #indexNumberHeader {
                width: 15%;
                height: 65px;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #repTypeHeader {
                width: 15%;
                height: 65px;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #actionHeader {
                width: 30%;
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
