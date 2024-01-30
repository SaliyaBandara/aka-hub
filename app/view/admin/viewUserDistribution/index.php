<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("viewUserDistribution");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>


    <div class="main-grid flex">
        <div class="leftViewUserDistribution">
            <div class="approveDivContainor">
                <div class="containorForcardArea">
                    <div class="tableContainor">
                        <div class="cardContainor">
                            <h3 class="h3-RepApprove">User Distribution in the System</h3>
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
                                    Registration Number
                                </div>
                                <div id="roleHeader" class="tableHeaderItem">
                                    Preview
                                </div>
                            </div>

                            <?php
                            foreach ($data["users"] as $user) {
                            ?>
                                <div class="approve-card">
                                    <div class="approve-card-div">
                                        <div id="roleName">
                                            <?php echo $user['name']; ?>
                                        </div>
                                        <div id="roleMail">
                                            <?php echo $user['email']; ?>
                                        </div>
                                        <div id="roleIndex">
                                            <?php echo $user['student_id']; ?>
                                        </div>
                                        <div class="rolePreview">
                                            <div class="previewButton">
                                                <a href="<?= BASE_URL ?>/viewUserDistribution/previewUser/<?php echo $user['id']; ?>">Preview</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- <div class="right">
            
        </div> -->
    </div>

    <style>
        .previewButton a {
            text-decoration: none;
            color: white;
        }

        .rolePreview {
            width: 25%;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 13px;
        }

        .rolePreview div {
            text-decoration: none;
            color: white;
            background-color: #2684FF;
            width: 40%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0px 0px 5px 0px #2684FF;
            border-radius: 5px;
        }

        .rolePreview div:hover {
            background-color: #2684FF;
            cursor: pointer;
        }

        #roleName {
            width: 25%;
            height: 20%;
        }

        #roleMail {
            width: 40%;
            height: 20%;
        }

        #roleIndex {
            width: 30%;
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

        .approveDivContainor {
            width: 100%;
            height: 500px;
        }

        .approveDivContainor h3 {
            text-align: center;
        }

        .main-grid {}

        .main-grid .leftViewUserDistribution {
            width: 100%;
            height: 850px;
            padding: 0 140px 0 140px;
        }

        .h3-RepApprove {
            text-align: center;
            margin-bottom: 20px;
            width: 100%;
        }

        #nameHeader {
            width: 25%;
            height: 55px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #mailHeader {
            width: 40%;
            height: 55px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #indexNumberHeader {
            width: 25%;
            height: 55px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #roleHeader {
            width: 25%;
            height: 60px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tableContainor {
            width: 100%;
            height: 90%;
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
            justify-content: center;
            align-items: center;
            padding: 30px;
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

</div>