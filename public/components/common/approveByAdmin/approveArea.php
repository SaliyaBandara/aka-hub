<?php

class ApproveArea
{

    public function render()
    {
?>
            <div class="containorForcardArea">
                <div class="tableContainor">
                    <div class="cardContainor">
                        <h3 class="h3-RepApprove">Representatives Approving Area</h3>
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
                        <div class="scrollableContainer">
                        <?php
                        $data = [
                            [
                                'student_name' => 'Binura',
                                'university_email' => '2021CS198@.stu.cmb.ac.lk',
                                'index_number' => '21001987',
                                'rep_type' => 'Student Rep'
                            ],
                            [
                                'student_name' => 'John Doe',
                                'university_email' => 'john.doe@example.com',
                                'index_number' => '12345678',
                                'rep_type' => 'Club Rep'
                            ],
                            [
                                'student_name' => 'Binura',
                                'university_email' => '2021CS198@.stu.cmb.ac.lk',
                                'index_number' => '21001987',
                                'rep_type' => 'Student Rep'
                            ],
                            [
                                'student_name' => 'John Doe',
                                'university_email' => 'john.doe@example.com',
                                'index_number' => '12345678',
                                'rep_type' => 'Club Rep'
                            ],
                            [
                                'student_name' => 'Binura',
                                'university_email' => '2021CS198@.stu.cmb.ac.lk',
                                'index_number' => '21001987',
                                'rep_type' => 'Student Rep'
                            ],
                            [
                                'student_name' => 'John Doe',
                                'university_email' => 'john.doe@example.com',
                                'index_number' => '12345678',
                                'rep_type' => 'Club Rep'
                            ],
                            [
                                'student_name' => 'Binura',
                                'university_email' => '2021CS198@.stu.cmb.ac.lk',
                                'index_number' => '21001987',
                                'rep_type' => 'Student Rep'
                            ],
                            [
                                'student_name' => 'John Doe',
                                'university_email' => 'john.doe@example.com',
                                'index_number' => '12345678',
                                'rep_type' => 'Club Rep'
                            ],
                            [
                                'student_name' => 'Binura',
                                'university_email' => '2021CS198@.stu.cmb.ac.lk',
                                'index_number' => '21001987',
                                'rep_type' => 'Student Rep'
                            ],
                            [
                                'student_name' => 'John Doe',
                                'university_email' => 'john.doe@example.com',
                                'index_number' => '12345678',
                                'rep_type' => 'Club Rep'
                            ],
                            [
                                'student_name' => 'Binura',
                                'university_email' => '2021CS198@.stu.cmb.ac.lk',
                                'index_number' => '21001987',
                                'rep_type' => 'Student Rep'
                            ],
                            [
                                'student_name' => 'John Doe',
                                'university_email' => 'john.doe@example.com',
                                'index_number' => '12345678',
                                'rep_type' => 'Club Rep'
                            ],
                            [
                                'student_name' => 'Binura',
                                'university_email' => '2021CS198@.stu.cmb.ac.lk',
                                'index_number' => '21001987',
                                'rep_type' => 'Student Rep'
                            ],
                            [
                                'student_name' => 'John Doe',
                                'university_email' => 'john.doe@example.com',
                                'index_number' => '12345678',
                                'rep_type' => 'Club Rep'
                            ],
                        ];
                        if(is_array($data)){
                            foreach ($data as $card) {
                        ?>
                            <div class="approve-card">
                                <div class="approve-card-div">
                                    <div id="repName">
                                        <?php echo $card['student_name']; ?>
                                    </div>
                                    <div id="repMail">
                                        <?php echo $card['university_email']; ?>
                                    </div>
                                    <div id="repIndex">
                                        <?php echo $card['index_number']; ?>
                                    </div>
                                    <div id="repType">
                                        <?php echo $card['rep_type']; ?>
                                    </div>
                                    <div class="repAccept">
                                        <div class="acceptButton">Accept</div>
                                    </div>
                                    <div class="repDecline">
                                        <div class="declineButton">Decline</div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    }
                        ?>                        
                    </div>
                </div>
            </div>
        </div>
        <style>
            .scrollableContainer {
                height: 430px;
                overflow-y: auto;
                overflow-x: hidden;
            }

            .h3-RepApprove {
                text-align: center;
                margin-bottom: 20px;
                width: 100%;
            }

            #nameHeader {
                width: 18%;
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
                width: 25%;
                height: 65px;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #repTypeHeader {
                width: 18%;
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
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
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
                width: 100%;
                height: 65px;
                background-color: #2684FF;
                opacity: 1;
                display: flex;
            }

            .cardContainor {
                width: 100%;
                height: 100%;
                /* padding-left: 100px; */
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

            .acceptButton {
                border: 1px solid #2684FF;
                width: 65%;
                height: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0px 0px 5px 0px #2684FF;
                border-radius: 5px;
            }

            .declineButton {
                border: 1px solid #ff9b2d;
                width: 65%;
                height: 80%;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0px 0px 5px 0px #ff9b2d;
                border-radius: 5px;
            }

            .acceptButton:hover {
                background-color: #2684FF;
                opacity: 1;
                cursor: pointer;
                color: white;
                font-size: 17.5px;
            }

            .declineButton:hover {
                background-color: #ff9b2d;
                opacity: 1;
                cursor: pointer;
                color: white;
                font-size: 17.5px;
            }

            #repName {
                width: 16%;
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

            #repType {
                width: 20%;
                height: 20%;
            }

            .repAccept {
                width: 15%;
                height: 65px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .repDecline {
                width: 15%;
                height: 38px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .acceptIcon {
                width: 65px;
                height: 65px;
            }

            .declineIcon {
                width: 35px;
                height: 35px;
            }

            .acceptIcon:hover {
                width: 67px;
                height: 67px;
                cursor: pointer;
            }

            .declineIcon:hover {
                width: 37px;
                height: 37px;
                cursor: pointer;
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
