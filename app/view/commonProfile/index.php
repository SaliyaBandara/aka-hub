<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("commonProfile");
$candidateCard = new CandidateCard();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Kasun", "Udara"); ?>


    <div class="main-grid flex">
        <div class="left">
            <div class="profileHeading">Your Profile</div>
            <div class="profileArea">
                <div class="profileImageArea">
                    <div class="profileImageContainer"><img class="profileImage" src="<?= BASE_URL ?>/public/assets/img/common/candidateImage.jpg" alt=""></img></div>
                </div>
                <div class="profileDetailArea">
                    <div class="profileDetailRow">
                        <div class="profileDetailHeader">Name : </div>
                        <div class="profileDetailCell">Samudi Perera</div>
                    </div>
                    <div class="profileDetailRow">
                        <div class="profileDetailHeader">Email Address : </div>
                        <div class="profileDetailCell">2021cs1234@ucsc.cmb.ac.lk</div>
                    </div>
                    <div class="profileDetailRow">
                        <div class="profileDetailHeader">Alternative Email : </div>
                        <div class="profileDetailCell">Samudi@gmail.com</div>
                    </div>
                    <div class="profileDetailRow">
                        <div class="profileDetailHeader">NIC : </div>
                        <div class="profileDetailCell">200256478654</div>
                    </div>
                    <div class="profileDetailRow">
                        <div class="profileDetailHeader">Contact Number : </div>
                        <div class="profileDetailCell">075984652</div>
                    </div>

                </div>
            </div>
            <div class="profileButtons">
                <div class="changePicture"><input type="button" class="profileButton" value="Change Picture" /></div>
                <div class="editDetailButton"><input type="button" class="profileButton" value="Edit Profile" /></div>
                <div class="changePasswordButton"><input type="button" class="profileButton" value="Change Password" /></div>
            </div>

        </div>
    </div>
</div>

<style>
    .main-grid {}

    .main-grid .left {
        width: 100%;
        height: 90vh;
        margin: 20px;
    }

    .profileHeading {
        margin-left: 20px;
        font-weight: bold;
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
        width: 50%;
        padding-top: 70px;
    }

    .profileImageArea {
        width: 50%;
        margin: 10px;
        padding: 4%;
        margin-top: 0px;
        padding-left: 15px;
    }

    .profileButtons {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
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
        margin-right: 10px;
    }

    .profileButton:hover {
        cursor: pointer;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
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
        width: 30%;
    }

    .changePasswordButton input {
        width: 200px;
    }
</style>

</div>
