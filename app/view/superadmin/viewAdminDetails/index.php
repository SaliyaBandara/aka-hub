<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("adminAccount");
$candidateCard = new CandidateCard();
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <?php

    if ($data["admin"]) {
        $userDetails = $data["admin"][0];
    }
    ?>
    <div class="main-grid flex">
        <div class="left">
            <div class="profileHeading">Preview Details of Admin</div>
            <div class="profileArea">
                <div class="profileImageArea">
                    <div class="profileImageContainer">
                        <img class="profileImage" alt="Admin Profile Image" src="<?= $userDetails['profile_img'] ?? '' ?>" />
                    </div>
                    <div class="editImageButton">
                        <a href="<?= BASE_URL ?>/adminAccount/">
                            <input type="button" class="profileButton" value="Back" />
                        </a>
                    </div>
                </div>
                <div class="profileDetailArea">
                    <div class="profileDetailRow">
                        <div class="profileDetailHeader">Name : </div>
                        <div class="profileDetailCell"><?= $userDetails['name'] ?? '' ?></div>
                    </div>
                    <div class="profileDetailRow">
                        <div class="profileDetailHeader">Email Address : </div>
                        <div class="profileDetailCell"><?= $userDetails['email'] ?? '' ?></div>
                    </div>
                    <div class="profileDetailRow">
                        <div class="profileDetailHeader">Alternative Email : </div>
                        <div class="profileDetailCell"><?= $userDetails['alt_email'] ?? '' ?></div>
                    </div>
                    <div class="profileDetailRow">
                        <div class="profileDetailHeader">Contact Number : </div>
                        <div class="profileDetailCell"><?= $userDetails['contact_number'] ?? '' ?></div>
                    </div>
                    <div class="profileDetailRow">
                        <div class="profileDetailHeader">Whatsapp Number : </div>
                        <div class="profileDetailCell"><?= $userDetails['whatsapp_number'] ?? '' ?></div>
                    </div>
                    <div class="profileDetailRow">
                        <div class="profileDetailHeader">Address : </div>
                        <div class="profileDetailCell"><?= $userDetails['address'] ?? '' ?></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .main-grid {}

        .main-grid .left {
            width: 100%;
            height: 100vh;
            margin: 20px;
        }

        .editImageButton a {
            text-decoration: none;
        }

        .profileHeading {
            margin-left: 20px;
            font-weight: bold;
        }

        .profileButton {
            text-decoration: none;
            color: white;
        }

        .notificationHeading {
            margin-top: 20px;
            margin-left: 20px;
            font-weight: bold;
        }

        .profileImage {
            border-radius: 100px;
            width: 200px;
            height: 200px;
            /* margin-left: 20px; */
            margin: 0 auto;
            margin-bottom: 20px;
            border: 5px solid rgba(38, 132, 255, 0.5)
        }

        .profileArea,
        .notificationDetailArea {
            display: flex;
            height: 45%;
        }

        .profileDetailArea {
            width: 65%;
            padding-top: 70px;

        }

        .profileImageArea {
            width: 35%;
            margin: 1%;
            padding: 4%;

        }

        .profileImageArea {
            width: 50%;
            margin: 10px;
            padding: 4%;
            margin-top: 0px;
        }

        .profileButton {
            width: 150px;
            height: 30px;
            background-color: #2684FF;
            border-radius: 5px;
            color: white;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            border: none;

        }

        .profileButton:hover {
            cursor: pointer;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .editImageButton {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 100px;
        }

        .profileDetailRow {
            display: flex;
            margin-top: 2%;
        }

        .profileDetailCell {
            justify-content: flex-start;
            margin-left: 5%;
        }

        .profileDetailHeader {
            width: 25%;
        }

        .notificationHeaders {
            width: 30%;
        }

        .notificationHeaders,
        .notificationInputs {
            padding-left: 30px;
            margin-top: 30px;
            width: 50%
        }

        .notificationHeader {
            margin: 2%;
            margin: 3%;
        }

        .notificationInputRow {
            display: flex;
            margin: 2.7%
        }

        .notificationInputCell {
            margin-right: 10px;
        }

        .profileButtons {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .saveButton input {
            margin-right: 20px;

        }

        .changePasswordButton input {
            width: 200px;
            margin-left: 20px;
        }
    </style>

</div>