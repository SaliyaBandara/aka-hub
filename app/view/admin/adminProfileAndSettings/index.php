<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("adminProfileAndSettings");
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <?php
    if ($data["admin_details"]) {
        $userDetails = $data["admin_details"][0];
        $systemDetails = $data["system_details"];
    }
    ?>

    <?php
    $img_src = USER_IMG_PATH . $userDetails["profile_img"];
    ?>

    <div class="main-grid flex">
        <div class="left">
            <div class="title font-1-5 font-semibold flex align-center">
                <i class='bx bxs-user-circle me-0-5'></i> Your Profile
            </div>
            <div class="profileArea">
                <div class="profileImageArea profileRow">
                    <div class="profileImage"><img src="<?= $img_src ?>" alt=""></div>
                </div>

                <div class="profileDetailNames profileRow font-medium">
                    <div>Name:</div>
                    <div>Email Address:</div>
                    <div>Alternative Email:</div>
                    <div>Contact Number:</div>
                    <div>Whatsapp Number:</div>
                    <div>Address:</div>
                </div>

                <div class="profileDetailValues profileRow">
                    <div><?= $userDetails["name"] ?></div>
                    <div><?= $userDetails["email"] ?></div>
                    <?php
                    if ($userDetails["alt_email"] == NULL) {
                        echo '<div class = "text-danger" > Not Specified </div>';
                    } else {
                        echo '<div>' . $userDetails["alt_email"] . '</div>';
                    }
                    ?>
                    <div><?= $userDetails["contact_number"] ?></div>
                    <div><?= $userDetails["whatsapp_number"] ?></div>
                    <div><?= $userDetails["address"] ?></div>
                </div>
            </div>
            <div class="flex notificationSettings">
                <div>
                    <a href="<?= BASE_URL ?>/adminProfileAndSettings/add_edit/<?= $userDetails["id"] ?>" class="btn btn-primary">
                        Edit Details
                    </a>
                    <button id="changePasswordBtn" class="btn btn-primary">Change Password</button>
                </div>
            </div>

            <div class="title font-1-5 font-semibold flex align-center">
                <i class='bx bxs-cog  me-0-5'></i> Admin settings
            </div>
            <div class="notificationArea">
                <div class="notificationDetails notificationRow font-medium">
                    <div>Academic Year Starting Date: </div>
                    <div>Academic Year Ending Date: </div>
                </div>
                <div class="notificationValues notificationRow">
                    <div>
                        <input type="date" id="academic_start_date" name="academic_start_date" placeholder="Enter academic start date" value="<?= date('Y-m-d', strtotime($systemDetails[1]["value"])) ?>" disabled />
                    </div>
                    <div>
                        <input type="date" id="<?= $key ?>" name="<?= $key ?>" placeholder="Enter academic end date" value="<?= date('Y-m-d', strtotime($systemDetails[0]["value"])) ?>" disabled />
                    </div>
                </div>
            </div>
            <div class="flex notificationSettings">
                <div>
                    <a href="<?= BASE_URL ?>/adminProfileAndSettings/add_edit_settings" class="btn btn-primary">
                        Edit Settings
                    </a>
                </div>
            </div>
        </div>
        <div class="popupBackground"></div>

        <div class="popup flex flex-column">
            <div class="popupHeader mb-2 text-secondary">Change Password</div>
            <div class="popupForm mt-2">
                <form action="" method="post" class="form">
                    <div class="mb-1 form-group">
                        <label for="name" class="form-label">Old Password</label>
                        <div class="flex flex-row passwordBox">
                            <input type="password" id="password" name="password" class="" value="">
                            <div class="showIcon" style="display: inline;">
                                <i class='bx bx-show feather-eye' style="cursor: pointer;"></i>
                                <i class='bx bx-hide feather-eye-off' style="display: none; cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1 form-group">
                        <label for="name" class="form-label">New Password</label>
                        <div class="flex flex-row passwordBox">
                            <input type="password" id="passwordNew" name="passwordNew" class="" value="">
                            <div class="showIcon" style="display: inline;">
                                <i class='bx bx-show feather-eye-new' style="cursor: pointer;"></i>
                                <i class='bx bx-hide feather-eye-off-new' style="display: none; cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>

                    <div class="mt-1-5 form-group">
                        <button class="btn btn-primary" id="changePassword">Change Password</button>
                    </div>

                </form>
            </div>
            <span class="closeButton">&times;</span>
        </div>

        <style>
            #datePicker1 {
                width: 20rem;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 1rem;
                background-color: #f5f5f5;
            }

            #datePicker2 {
                width: 20rem;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 1rem;
                background-color: #f5f5f5;
            }

            .main-grid .left {
                width: 100% !important;
                height: 100vh;
                margin: 20px;
            }

            .profileImage {
                border-radius: 200px;
                border: 1px solid black;
                width: 15rem;
                height: 15rem;
                margin: 0 auto;
                overflow: hidden;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .profileImage img {
                display: block;
                width: 30rem;
                height: 30rem;
            }

            .profileImageArea {
                display: flex;
                justify-content: center;
                flex-direction: column;
                width: 40% !important;
                /* border: 1px solid red; */
            }

            .profileArea {
                margin-top: 50px;
            }

            .profileArea,
            .notificationArea {
                display: flex;
                flex-direction: row;
                height: auto;
                /* border: 1px solid red; */
            }

            .profileRow {
                margin: 2rem 1rem 2rem 0 !important;
                /* border: 1px solid red; */
                width: 40%;
            }

            .profileRow div {
                padding: 0.5rem;
            }

            .profileDetailNames {
                justify-content: right;
                text-align: left;
                display: flex;
                flex-direction: column;
                width: 20% !important;
            }

            .notificationSettings {
                margin: 2rem;
                justify-content: flex-end;
            }

            .notificationSettings {
                margin: 2rem;
                justify-content: flex-end;
            }

            .notificationRow {
                margin: 2rem 0 2rem 0 !important;
                /* border: 1px solid red; */
                width: 47%;
            }

            .notificationRow div {
                padding: 0.6rem;
            }

            .notificationDetails {
                justify-content: right;
                text-align: left;
                display: flex;
                flex-direction: column;
            }

            .warningNone {
                display: inline !important;
            }

            .notificationValues input[type="checkbox"] {
                margin-right: 0.5rem;
                width: 1rem;
                height: 1rem;
            }

            .notificationValues label {
                margin-right: 2rem;
                font-size: 1rem;
            }

            .notificationValues select {
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 1rem;
                width: 20rem;
                background-color: #f5f5f5;
            }

            .passwordBox {
                display: block;
                width: 100%;
                height: calc(1.5em + 0.75rem + 2px);
                padding: 0.375rem 0.75rem;
                font-size: var(--rv-1-new);
                font-weight: 400;
                line-height: 1.5;
                color: #495057;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            .passwordBox:focus-within {
                color: #495057;
                background-color: #fff;
                border-color: #80bdff;
                outline: 0;
                box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
            }

            .passwordBox input {
                outline: none;
                border: none;
                width: 95%;
            }

            .passwordBox input:focus {
                outline: none;
                border: none;
            }

            .popup {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: white;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                z-index: 9999;
                display: none;
            }

            .popupHeader {
                font-size: 1.2rem;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .popupForm {
                width: 500px;
            }

            .popupBackground {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                /* Semi-transparent black background */
                z-index: 9998;
                display: none;
            }

            .closeButton {
                position: absolute;
                top: 10px;
                right: 10px;
                cursor: pointer;
                font-size: 1.2rem;
            }
        </style>


        <?php $HTMLFooter = new HTMLFooter(); ?>
        <script>
            let BASE_URL = "<?= BASE_URL ?>";
        </script>


        <script>
            $(document).ready(function() {
                $('#changePasswordBtn').click(function(event) {
                    event.preventDefault();

                    $('.popupBackground').fadeIn();
                    $('.popup').fadeIn();
                });

                $('.closeButton, .popupBackground').click(function() {
                    $('.popupBackground').fadeOut();
                    $('.popup').fadeOut();
                });
            });

            $(document).on("click", ".feather-eye", function() {
                $(this).hide();
                $(this).siblings(".feather-eye-off").show();
                $(this).parent().siblings("input").attr("type", "text");
            });

            $(document).on("click", ".feather-eye-off", function() {
                $(this).hide();
                $(this).siblings(".feather-eye").show();
                $(this).parent().siblings("input").attr("type", "password");
            });

            $(document).on("click", ".feather-eye-new", function() {
                $(this).hide();
                $(this).siblings(".feather-eye-off-new").show();
                $(this).parent().siblings("input").attr("type", "text");
            });

            $(document).on("click", ".feather-eye-off-new", function() {
                $(this).hide();
                $(this).siblings(".feather-eye-new").show();
                $(this).parent().siblings("input").attr("type", "password");
            });

            $(document).on("click", "#changePassword", function(event) {

                event.preventDefault();
                var oldPassword = $('#password').val();
                var newPassword = $('#passwordNew').val();

                if (!confirm("Are you sure you want to change your password?"))
                    return;

                $.ajax({
                    url: `${BASE_URL}/adminProfileAndSettings/changePassword`,
                    type: 'post',
                    data: {
                        oldPassword: oldPassword,
                        newPassword: newPassword,
                        changePassword: true
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", response['desc'])
                            setTimeout(function() {
                                history.go(-1);
                                window.close();
                            }, 2000);

                        } else if (response['status'] == 403)
                            alertUser("danger", response['desc'])
                        else
                            alertUser("warning", response['desc'])
                    },
                    error: function(ajaxContext) {
                        alertUser("danger", "Something Went Wrong")
                    }
                });
            });
        </script>