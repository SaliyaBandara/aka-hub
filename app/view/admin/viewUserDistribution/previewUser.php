<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("viewUserDistribution");
$candidateCard = new CandidateCard();
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <?php

    if (isset($data["user"]) && is_array($data["user"]) && count($data["user"]) > 0) {
        $userDetails = $data["user"];
    }

    ?>
    <?php
    $img_src = USER_IMG_PATH . $userDetails["profile_img"];
    ?>
    <div class="main-grid flex">
        <div class="left">
            <div class="title font-1-5 font-semibold flex align-center">
                <i class='bx bxs-user-circle me-0-5'></i> Preview Details of User
            </div>
            <div class="profileArea">
                <div class="profileImageArea profileRow">
                    <div class="profileImage"><img src="<?= $img_src ?>" alt="No Image Uploaded"></div>
                </div>
                <div class="profileDetailNames profileRow font-medium">
                    <div>Name:</div>
                    <div>Email Address:</div>
                    <div>Alternative Email:</div>
                    <?php if ($userDetails["club_rep"] === 1) {
                        echo '<div>Club Name:</div>';
                    } ?>
                    <?php
                    if ($userDetails["role"] == 1) {
                        echo '<div>Contact Number:</div>';
                        echo '<div>Whatsapp Number:</div>';
                        echo '<div>Address:</div>';
                    } else if ($userDetails["role"] === 5) {
                        echo '<div>Contact Number:</div>';
                        echo '<div>Counselor Type:</div>';
                    } else if ($userDetails["role"] !== 3) {
                        echo '<div>Faculty:</div>';
                        echo '<div>Degree:</div>';
                        echo '<div>Year:</div>';
                        echo '<div>Registration Number:</div>';
                        echo '<div>Index Number:</div>';
                    }
                    ?>
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
                    <?php if ($userDetails["club_rep"] === 1) {
                        echo '<div>Club Name:</div>';
                    } ?>
                    <?php
                    if ($userDetails["role"] == 1) {
                        echo '<div>' . $userDetails["contact_number"] . '</div>';
                        echo '<div>' . $userDetails["whatsapp_number"] . '</div>';
                        echo '<div>' . $userDetails["address"] . '</div>';
                    } else if ($userDetails["role"] === 5) {
                        echo '<div>' . $userDetails["contact"] . '</div>';
                        if ($userDetails["type"] === 1) {
                    ?>
                            <div>Professional Counselor</div>
                        <?php
                        } else if ($userDetails["type"] === 2) {
                        ?>
                            <div>Student Counselor</div>
                    <?php
                        }
                    } else if ($userDetails["role"] !== 3) {
                        echo '<div>' . $userDetails["faculty"] . '</div>';
                        echo '<div>' . $userDetails["degree"] . '</div>';
                        echo '<div>' . $userDetails["year"] . '</div>';
                        echo '<div>' . $userDetails["student_id"] . '</div>';
                        echo '<div>' . $userDetails["index_number"] . '</div>';
                    }
                    ?>
                </div>
                <div class="flex notificationSettings">
                    <div>
                        <a href="<?= BASE_URL ?>/viewUserDistribution" class="btn btn-primary">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .main-grid {}

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
    </style>

</div>