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
            </style>

        </div>
        <?php $HTMLFooter = new HTMLFooter(); ?>
        <script>
            let BASE_URL = "<?= BASE_URL ?>";
        </script>