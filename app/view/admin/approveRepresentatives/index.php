<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("approveRepresentatives");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>


    <div class="main-grid flex">
        <div class="left">
            <div class="approveDivContainor">
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
                                    Reg Number
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

                                if (is_array($data["approveRequests"])) {
                                    foreach ($data["approveRequests"] as $card) {
                                        if ($card['student_rep'] == 2 && $card['club_rep'] == 2) {
                                ?>
                                            <div class="approve-card">
                                                <div class="approve-card-div">
                                                    <div id="repName">
                                                        <?php echo isset($card['name']) ? $card['name'] : ''; ?>
                                                    </div>
                                                    <div id="repMail">
                                                        <?php echo isset($card['email']) ? $card['email'] : ''; ?>
                                                    </div>
                                                    <div id="repIndex">
                                                        <?php echo isset($card['student_id']) ? $card['student_id'] : ''; ?>
                                                    </div>
                                                    <div id="repType">
                                                        <?php
                                                        echo 'Student Rep';
                                                        ?>
                                                    </div>
                                                    <div class="repAccept">
                                                        <div href="<?php echo BASE_URL; ?>/approveRepresentatives/acceptRole/<?php echo urlencode($card['id']); ?>/student_rep" class="repAcceptButonStudentRep" data-role="representativeAcceptStudentRep" data-id="<?php echo $card['id']; ?>">
                                                            <div class="acceptButton">Accept</div>
                                                        </div>
                                                    </div>
                                                    <div class="repDecline">
                                                        <div href="<?php echo BASE_URL; ?>/approveRepresentatives/declineRole/<?php echo urlencode($card['id']); ?>/student_rep" class="repDeclineButonStudentRep" data-role="representativeDeclineStudentRep" data-id="<?php echo $card['id']; ?>">
                                                            <div class="declineButton">Decline</div>
                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="approve-card">
                                                <div class="approve-card-div">
                                                    <div id="repName">
                                                        <?php echo isset($card['name']) ? $card['name'] : ''; ?>
                                                    </div>
                                                    <div id="repMail">
                                                        <?php echo isset($card['email']) ? $card['email'] : ''; ?>
                                                    </div>
                                                    <div id="repIndex">
                                                        <?php echo isset($card['student_id']) ? $card['student_id'] : ''; ?>
                                                    </div>
                                                    <div id="repType">
                                                        <?php
                                                        echo 'Club Rep';
                                                        ?>
                                                    </div>
                                                    <div class="repAccept">
                                                        <div href="<?php echo BASE_URL; ?>/approveRepresentatives/acceptRole/<?php echo urlencode($card['id']); ?>/club_rep" class="repAcceptButonClubRep" data-role="representativeAcceptClubRep" data-id="<?php echo $card['id']; ?>">
                                                            <div class="acceptButton">Accept</div>
                                        </div>
                                                    </div>
                                                    <div class="repDecline">
                                                        <div href="<?php echo BASE_URL; ?>/approveRepresentatives/declineRole/<?php echo urlencode($card['id']); ?>/club_rep" class="repDeclineButonClubRep" data-role="representativeDeclineClubRep" data-id="<?php echo $card['id']; ?>">
                                                            <div class="declineButton">Decline</div>
                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="approve-card">
                                                <div class="approve-card-div">
                                                    <div id="repName">
                                                        <?php echo isset($card['name']) ? $card['name'] : ''; ?>
                                                    </div>
                                                    <div id="repMail">
                                                        <?php echo isset($card['email']) ? $card['email'] : ''; ?>
                                                    </div>
                                                    <div id="repIndex">
                                                        <?php echo isset($card['student_id']) ? $card['student_id'] : ''; ?>
                                                    </div>
                                                    <div id="repType">
                                                        <?php
                                                        if (isset($card['student_rep']) && $card['student_rep'] == 2) {
                                                            echo 'Student Rep';
                                                        } else if (isset($card['club_rep']) && $card['club_rep'] == 2) {
                                                            echo 'Club Rep';
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="repAccept">
                                                        <?php
                                                        if (isset($card['student_rep']) && $card['student_rep'] == 2) {
                                                            echo '<div href="' . BASE_URL . '/approveRepresentatives/acceptRole/' . urlencode($card['id']) . '/student_rep" class="repAcceptButonStudentRep" data-role="representativeAcceptStudentRep" data-id="' . $card['id'] . '">';
                                                            echo '<div class="acceptButton">Accept</div>';
                                                            echo '</div>';
                                                        } elseif (isset($card['club_rep']) && $card['club_rep'] == 2) {
                                                            echo '<div href="' . BASE_URL . '/approveRepresentatives/acceptRole/' . urlencode($card['id']) . '/club_rep" class="repAcceptButonClubRep" data-role="representativeAcceptClubRep" data-id="' . $card['id'] . '">';
                                                            echo '<div class="acceptButton">Accept</div>';
                                                            echo '</div>';
                                                        } else {
                                                            echo '<div href="' . BASE_URL . '/approveRepresentatives/acceptStudentRep" class="repAcceptButon" data-role="representativeAcceptStudentRep" data-id="' . $card['id'] . '">';
                                                            echo '<div class="acceptButton">Accept</div>';
                                                            echo '</div>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="repDecline">
                                                        <?php
                                                        if (isset($card['student_rep']) && $card['student_rep'] == 2) {
                                                            echo '<div href="' . BASE_URL . '/approveRepresentatives/declineRole/' . urlencode($card['id']) . '/student_rep" class="repDeclineButonStudentRep" data-role="representativeDeclineStudentRep" data-id="' . $card['id'] . '">';
                                                            echo '<div class="declineButton">Decline</div>';
                                                            echo '</div>';
                                                        } elseif (isset($card['club_rep']) && $card['club_rep'] == 2) {
                                                            echo '<div href="' . BASE_URL . '/approveRepresentatives/declineRole/' . urlencode($card['id']) . '/club_rep" class="repDeclineButonClubRep" data-role="representativeDeclineClubRep" data-id="' . $card['id'] . '">';
                                                            echo '<div class="declineButton">Decline</div>';
                                                            echo '</div>';
                                                        } else {
                                                            echo '<div href="' . BASE_URL . '/approveRepresentatives/acceptStudentRep" class="repAcceptButon" data-role="representativeAccept" data-id="' . $card['id'] . '">';
                                                            echo '<div class="declineButton">Decline</div>';
                                                            echo '</div>';
                                                        }
                                                        ?>
                                                    </div>


                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="right">
            
        </div> -->
    </div>

    <style>
        .approveDivContainor {
            width: 100%;
            height: 100vh;
        }

        .approveDivContainor h3 {
            text-align: center;
        }

        .main-grid {}

        .main-grid .left {
            width: 100% !important;
            height: 1350px;
            padding: 0 150px 0 150px;
        }

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

        .repAccept div {
            text-decoration: none;
            color: white;
            background-color: #2684FF;
            width: 65%;
            height: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0px 0px 5px 0px #2684FF;
            border-radius: 5px;
        }

        .repAccept div:hover {
            background-color: #2684FF;
            cursor: pointer;
        }

        .repDecline {
            width: 15%;
            height: 38px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .repDecline div {
            text-decoration: none;
            color: white;
            background-color: #ff9b2d;
            width: 65%;
            height: 80%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0px 0px 5px 0px #ff9b2d;
            border-radius: 5px;
        }

        .repDecline div:hover {
            background-color: #ff9b2d;
            cursor: pointer;
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

    <?php $HTMLFooter = new HTMLFooter(); ?>
    <script>
        let BASE_URL = "<?= BASE_URL ?>";
    </script>

    <script>
        $(document).ready(function() {
            $(document).on("click", ".repAcceptButonStudentRep", function(event) {
                event.preventDefault();
                let id = $(this).attr("data-id");
                $.ajax({
                    url: `${BASE_URL}/approveRepresentatives/acceptRole/${id}/student_rep`,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", `Accepted successfully.`);
                            // get the closest tr
                            this_btn.closest("tr").remove();
                            window.location.reload();
                            // buttonElement.closest("tr").remove();

                        } else {
                            alertUser("warning", response['desc']);
                        }
                    },
                    error: function(ajaxContext) {
                        alertUser("danger", "Something Went Wrong");
                    }
                });
            });

            $(document).on("click", ".repAcceptButonClubRep", function(event) {
                event.preventDefault();
                let id = $(this).attr("data-id");
                $.ajax({
                    url: `${BASE_URL}/approveRepresentatives/acceptRole/${id}/club_rep`,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", `Accepted successfully.`);
                            $(this).closest("tr").remove();
                            buttonElement.closest("tr").remove();
                            window.location.reload();
                        } else {
                            alertUser("warning", response['desc']);
                        }
                    },
                    error: function(ajaxContext) {
                        alertUser("danger", "Something Went Wrong");
                    }
                });
            });

            $(document).on("click", ".repDeclineButonStudentRep", function(event) {
                event.preventDefault();
                let id = $(this).attr("data-id");
                $.ajax({
                    url: `${BASE_URL}/approveRepresentatives/declineRole/${id}/student_rep`,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", `Denied successfully.`);
                            $(this).closest("tr").remove();
                            buttonElement.closest("tr").remove();
                            window.location.reload();
                        } else {
                            alertUser("warning", response['desc']);
                        }
                    },
                    error: function(ajaxContext) {
                        alertUser("danger", "Something Went Wrong");
                    }
                });
            });

            $(document).on("click", ".repDeclineButonClubRep", function(event) {
                event.preventDefault();
                let id = $(this).attr("data-id");
                $.ajax({
                    url: `${BASE_URL}/approveRepresentatives/declineRole/${id}/club_rep`,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", `Denied successfully.`);
                            $(this).closest("tr").remove();
                            window.location.reload();
                        } else {
                            alertUser("warning", response['desc']);
                        }
                    },
                    error: function(ajaxContext) {
                        alertUser("danger", "Something Went Wrong");
                    }
                });
            });
        });
    </script>
</div>