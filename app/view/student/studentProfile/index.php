<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar();
$candidateCard = new CandidateCard();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Samudi", "Perera"); ?>
    <div class="main-grid flex">
        <div class="left">
            <div class ="profileHeading">Your Profile</div>
            <div class = "profileArea">
                <div class = "profileImageArea">
                    <div class = "profileImageContainer"><img class = "profileImage" src="<?= BASE_URL ?>/public/assets/img/common/candidateImage.jpg" alt=""></img></div>
                    <div class = "editImageButton"><input type = "button" class = "profileButton" value = "Change Picture"/></div>
                </div>
                <div class = "profileDetailArea">
                    <div class = "profileDetailRow"><div class = "profileDetailHeader">Name : </div><div class = "profileDetailCell">Samudi Perera</div></div>
                    <div class = "profileDetailRow"><div class = "profileDetailHeader">Email Address : </div><div class = "profileDetailCell">2021cs1234@ucsc.cmb.ac.lk</div></div>
                    <div class = "profileDetailRow"><div class = "profileDetailHeader">Degree : </div><div class = "profileDetailCell">Computer Science</div></div>
                    <div class = "profileDetailRow"><div class = "profileDetailHeader">Index Number : </div><div class = "profileDetailCell">21001234</div></div>
                    <div class = "profileDetailRow"><div class = "profileDetailHeader">Alternative Email : </div><div class = "profileDetailCell">Samudi@gmail.com</div></div>
                </div>
            </div>
            <hr></hr>
            <div class ="notificationHeading">Notification Settings</div>
            <div class = "notificationDetailArea">
                <div class = "notificationHeaders">
                    <div class ="notificationHeader">Preferred Email Address to receive Notifications</div>
                    <div class ="notificationHeader">Send Exam and Assignment Notifications</div>
                    <div class ="notificationHeader">Send Reminder Notifications through</div>
                    <div class ="notificationHeader">Send Reminder Notifications (No. of days before) </div>
                    <div class ="notificationHeader">Send New Club Event Post Notifications</div>
                    <div class ="notificationHeader">Send New Material update Notifications</div>
                </div>
                <div class = "notificationInputs">
                    <form>
                        <div class = "notificationInputRow">
                            <select id="emailAddress" name="emailAddress">
                                <option value="21cs1234@ucsc.amb.ac.lk">21cs1234@ucsc.amb.ac.lk</option>
                                <option value="samudi@gmail.com" selected>samudi@gmail.com</option>
                            </select>
                        </div>
                        <div class = "notificationInputRow">
                            <div class = "notificationInputCell">
                                <input type="checkbox" id="type1" name="onsite" value="onsite">
                                <label for="type1">Onsite Notifications</label>
                            </div>
                            <div class = "notificationInputCell">
                                <input type="checkbox" id="type2" name="email" value="email" checked>
                                <label for="type2">Emails</label>
                            </div>
                            <div class = "notificationInputCell">
                                <input type="checkbox" id="type3" name="none" value="none">
                                <label for="type3">None</label>
                            </div>
                        </div>
                        <div class = "notificationInputRow">
                            <div class = "notificationInputCell">
                                <input type="checkbox" id="type1" name="onsite" value="onsite" checked>
                                <label for="type1">Onsite Notifications</label>
                            </div>
                            <div class = "notificationInputCell">
                                <input type="checkbox" id="type2" name="email" value="email">
                                <label for="type2">Emails</label>
                            </div>
                            <div class = "notificationInputCell">
                                <input type="checkbox" id="type3" name="none" value="none">
                                <label for="type3">None</label>
                            </div>
                        </div>
                        <div class = "notificationInputRow">
                            <select id="daycount" name="daycount">
                                <option value="2weeks" selected>Before 2 weeks</option>
                                <option value="1week">Before 1 week</option>
                                <option value="1day">Before 1 day</option>

                            </select>
                        </div>
                        <div class = "notificationInputRow">
                            <div class = "notificationInputCell">
                                <input type="checkbox" id="type1" name="onsite" value="onsite" checked>
                                <label for="type1">Onsite Notifications</label>
                            </div>
                            <div class = "notificationInputCell">
                                <input type="checkbox" id="type2" name="email" value="email">
                                <label for="type2">Emails</label>
                            </div>
                            <div class = "notificationInputCell">
                                <input type="checkbox" id="type3" name="none" value="none">
                                <label for="type3">None</label>
                            </div>
                        </div>
                        <div class = "notificationInputRow">
                            <div class = "notificationInputCell">
                                <input type="checkbox" id="type1" name="onsite" value="onsite">
                                <label for="type1">Onsite Notifications</label>
                            </div>
                            <div class = "notificationInputCell">
                                <input type="checkbox" id="type2" name="email" value="email">
                                <label for="type2">Emails</label>
                            </div>
                            <div class = "notificationInputCell">
                                <input type="checkbox" id="type3" name="none" value="none" checked>
                                <label for="type3">None</label>
                            </div>
                        </div>
                    </form>
                    <div class ="profileButtons">
                        <div class = "saveButton"><input type = "button" class = "profileButton" value = "Save Changes"/></div>
                        <div class = "editDetailButton"><input type = "button" class = "profileButton" value = "Edit Profile"/></div>
                        <div class = "changePasswordButton"><input type = "button" class = "profileButton" value = "Change Password"/></div>
                    </div>
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

        .profileHeading {
            margin-left : 20px;
            font-weight : bold;
        }

        .notificationHeading{
            margin-top : 20px;
            margin-left : 20px;
            font-weight : bold;
        }

        .profileImage{
            border-radius: 100px;
            width: 200px;
            height: 200px;
            /* margin-left: 20px; */
            margin: 0 auto;
            margin-bottom: 20px;
            border : 5px solid rgba(38,132,255, 0.5)
        }

        .profileArea, .notificationDetailArea {
            display : flex;
            height : 45%;
        }

        .profileDetailArea{
            width : 65%;
            padding-top: 70px;
            
        }

        .profileImageArea{
            width : 35%;
            margin : 1%;
            padding : 4%;

        }

        .profileImageArea{
            width : 50%;
            margin : 10px;
            padding : 4%;
            margin-top : 0px;
        }

        .profileButton{
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
            border : none;

        }

        .profileButton:hover {
            cursor: pointer;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .editImageButton{
            display : flex;
            align-items : center;
            justify-content : center;
        }
        
        .profileDetailRow{
            display : flex;
            margin-top : 2%;
        }

        .profileDetailCell{
            justify-content: flex-start;
            margin-left : 5%;
        }

        .profileDetailHeader{
            width:25%;
        }

        .notificationHeaders{
            width:30%;
        }

        .notificationHeaders, .notificationInputs{
            padding-left : 30px;
            margin-top : 30px;
            width: 50%
        }

        .notificationHeader{
            margin: 2%;
            margin: 3%;
        }

        .notificationInputRow{
            display : flex;
            margin : 2.7%
        }

        .notificationInputCell{
            margin-right : 10px;
        }

        .profileButtons{
            display :flex;
            justify-content : flex-end;
            margin-top : 30px;
        }

        .saveButton input{
            margin-right : 20px;
            
        }

        .changePasswordButton input{
            width : 200px;
            margin-left: 20px;
        }

    </style>

</div>