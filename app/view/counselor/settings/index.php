<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("counselorSettings");
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <?php
    if ($data["admin_details"]) {
        $userDetails = $data["admin_details"][0];
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
                    <div>Counselor Type:</div>
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
                    <div><?= $userDetails["contact"] ?></div>
                    <?php
                    if ($userDetails["type"] == 1) {
                        echo '<div> Professional Counselor </div>';
                    } else {
                        echo '<div> Student Counselor </div>';
                    }
                    ?>
                </div>
            </div>
            <div class="flex notificationSettings">
                <div>
                    <a href="<?= BASE_URL ?>/counselorSettings/add_edit/<?= $userDetails["id"] ?>" class="btn btn-primary">
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
            width: 250px;
            height:250px;
        }

        .profileImage img .img{
            object-fit: cover;
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