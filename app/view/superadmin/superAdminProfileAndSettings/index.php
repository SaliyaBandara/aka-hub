<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("superAdminProfileAndSettings");

?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <?php
    if ($data["super_admin_details"]) {
        $userDetails = $data["super_admin_details"];
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
                </div>
            </div>
            <div class="flex notificationSettings">
                <div>
                    <a href="<?= BASE_URL ?>/superAdminProfileAndSettings/add_edit/<?= $userDetails["id"] ?>" class="btn btn-primary">
                        Edit Details
                    </a>
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
            width: 15rem;
            height: 15rem;
            margin: 0 auto;
            border: 5px solid rgba(38, 132, 255, 0.5);
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

        .notificationSettings {
            margin: 2rem;
            justify-content: flex-end;
        }
    </style>

</div>
<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>