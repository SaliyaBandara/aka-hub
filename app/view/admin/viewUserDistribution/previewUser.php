<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("viewUserDistribution");
?>

<?php

if (isset($data["user"]) && is_array($data["user"]) && count($data["user"]) > 0) {
    $userDetails = $data["user"];
    $id = $data["id"];
}

?>
<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
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
                        echo '<div>' . $userDetails["club_name"] . '</div>';
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
                        if ($userDetails["index_number"] !== " ") {
                            echo '<div>' . $userDetails["index_number"] . '</div>';
                        } else {
                            echo '<div class = "text-danger" > Not Specified </div>';
                        }
                    }
                    ?>
                </div>
                <div class="flex notificationSettings">
                    <div>
                        <a href="<?= BASE_URL ?>/viewUserDistribution" class="btn btn-info mx-1">
                            Back
                        </a>
                    </div>
                    <div class="">
                        <?php
                        $isRestricted = $data["isRestricted"];
                        $buttonClass = ($isRestricted == 1) ? 'btn btn-primary' : 'btn btn-danger';
                        $buttonText = ($isRestricted == 1) ? 'Enable' : 'Restrict';
                        $buttonLink = ($isRestricted == 1) ? BASE_URL . '/viewUserDistribution/restrictUser/' . $userDetails["id"] : BASE_URL . '/viewUserDistribution/restrictUser/' . $userDetails["id"];
                        ?>
                        <a class="restrictButton <?= $buttonClass ?> mx-0.5" href="<?= $buttonLink ?>">
                            <?= $buttonText ?>
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

        .btn {
            text-decoration: none;
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
<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>

<script>
    $(document).on("click", ".restrictButton", function(event) {
        event.preventDefault();
        let button = $(this);
        let urlParts = $(this).attr("href").split('/');
        let url = $(this).attr("href");
        let id = urlParts[urlParts.length - 1];
        if (!confirm("Are you sure you want to restrit or enable this user?")) {
            return;
        }

        $.ajax({
            url: `${BASE_URL}/viewUserDistribution/restrictUser/${id}`,
            type: 'post',
            dataType: 'json',
            success: function(response) {
                if (response.status == 200) {
                    alertUser("success", response.desc);
                    button.toggleClass("btn-danger btn-primary").text("Enable");
                    if (button.hasClass("btn-danger")) {
                        button.text("Restrict");
                    } else {
                        button.text("Enable");
                    }
                } else {
                    alertUser("warning", response.desc);
                }
            },
            error: function(ajaxContext) {
                alertUser("danger", "Something Went Wrong");
            }
        });
    });
</script>