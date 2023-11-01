<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("existingCounselors");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Kasun", "Udara"); ?>

    <div class="main-grid flex">
        <!-- <div class="left"> -->
        <div class="divExistingCounselors">
            <h3>Existing Counselors</h3>
            <div class="divCounselorCards">
                <div class="conunselorCardLine">
                    <!-- <div class="counselorCard">
                            <h4>Proffessional Counselor</h4>
                            <div class="counselor-image-containor">
                                <img src="<?= BASE_URL ?>/public/assets/img/counselors/counselorImage.jpg" alt="" id = "counselorPhoto">
                            </div>
                            <h5>A.H.T.N Thushanthika</h5>
                            <h5>a.h.t.n.thushanthika@gmail.com</h5>
                            <p>Senior Lecturer in Computer Science; Researcher in Extended Reality, Human Computer Interaction, User Experience Design, Haptics, Virtual Taste & Smell, and Magnetic User Interfaces</p>
                            <div class="edit-delete-containor">
                                <div class="iconContainor">
                                    <img src="<?= BASE_URL ?>/public/assets/img/icons/edit.png" alt="">
                                </div>
                                <div class="iconContainor">
                                    <img src="<?= BASE_URL ?>/public/assets/img/icons/rejected.png" alt="">
                                </div>
                            </div>
                        </div> -->

                    <?php

                    if (is_array($data["counselors"])) {
                        foreach ($data["counselors"] as $key => $value) {
                            if ($value["role"] == 5) {
                                echo "<div class='counselorCard'>";
                                echo "<h4>Student Counselor</h4>";
                                echo "<div class='counselor-image-containor'>";
                                echo "<img src='" . BASE_URL . "/public/assets/img/counselors/counselorImage.jpg' alt='' id = 'counselorPhoto'>";
                                echo "</div>";
                                echo "<h5>" . $value["name"] . "</h5>";
                                echo "<h5>" . $value["email"] . "</h5>";
                                // echo "<p>".$value["description"]."</p>";
                                echo "<div class='edit-delete-containor'>";
                                echo "<a href='" . BASE_URL . "/addCounselors/index/" . $value["id"] . "' class='block iconContainor'>";
                                echo "<img src='" . BASE_URL . "/public/assets/img/icons/edit.png' alt=''>";
                                echo "</a>";
                                echo "<div class='iconContainor delete-item' data-id='" . $value["id"] . "'>";
                                echo "<img src='" . BASE_URL . "/public/assets/img/icons/rejected.png' alt=''>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                        }
                    }

                    ?>


                    <!-- <div class="counselorCard">
                            <h4>Student Counselor</h4>
                            <div class="counselor-image-containor">
                                <img src="<?= BASE_URL ?>/public/assets/img/counselors/counselorImage.jpg" alt="" id = "counselorPhoto">
                            </div>
                            <h5>Dr. Lasanthi De Silva</h5>
                            <h5>lnc@ucsc.cmb.ac.lk</h5>
                            <p>Senior Lecturer in Computer Science; Researcher in Extended Reality, Human Computer Interaction, User Experience Design, Haptics, Virtual Taste & Smell, and Magnetic User Interfaces</p>
                            <div class="edit-delete-containor">
                                <div class="iconContainor">
                                    <img src="<?= BASE_URL ?>/public/assets/img/icons/edit.png" alt="">
                                </div>
                                <div class="iconContainor">
                                    <img src="<?= BASE_URL ?>/public/assets/img/icons/rejected.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="counselorCard">
                            <h4>Student Counselor</h4>
                            <div class="counselor-image-containor">
                                <img src="<?= BASE_URL ?>/public/assets/img/counselors/counselorImage.jpg" alt="" id = "counselorPhoto">
                            </div>
                            <h5>Dr. Kasun Karunanayake</h5>
                            <h5>ktk@ucsc.cmb.ac.lk</h5>
                            <p>Senior Lecturer in Computer Science; Researcher in Extended Reality, Human Computer Interaction, User Experience Design, Haptics, Virtual Taste & Smell, and Magnetic User Interfaces</p>
                            <div class="edit-delete-containor">
                                <div class="iconContainor">
                                    <img src="<?= BASE_URL ?>/public/assets/img/icons/edit.png" alt="">
                                </div>
                                <div class="iconContainor">
                                    <img src="<?= BASE_URL ?>/public/assets/img/icons/rejected.png" alt="">
                                </div>
                            </div>
                        </div> -->
                </div>
                <div class="buttonDivToAddCounselors">
                    <div class="gotoAddCounselor">
                        <div>
                            <a href="<?= BASE_URL ?>/addCounselors/index/0" class="mwb-form-submit-btn">Add Counselor</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- </div> -->
        <!-- <div class="right">
            
        </div> -->
    </div>

    <style>
        .main-grid {}

        .delete-item {
            cursor: pointer;
        }

        .mwb-form-submit-btn {
            background-color: #2684FF;
            border-radius: 4px;
            border: none;
            color: #ffffff;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            min-width: 200px;
            padding: 16px 10px;
        }

        .mwb-form-submit-btn :hover {
            background-color: white;
            border-radius: 4px;
            border: none;
            color: black;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            min-width: 200px;
            padding: 16px 10px;
        }

        .buttonDivToAddCounselors {
            width: 100%;
            height: 500px;
            display: flex;
            justify-content: right;
            margin-top: 50px;
            padding: 0 100px 20px 0;
        }

        .gotoAddCounselor {
            width: 120px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .gotoAddCounselor a {
            text-decoration: none;
        }

        .iconContainor {
            width: 30px;
            height: 30px;
            margin: 5px;
        }

        .edit-delete-containor {
            width: 100%;
            height: 50px;
            display: flex;
            justify-content: right;
            align-items: center;
            padding-right: 20px;
        }

        .iconContainor img {
            width: 30px;
            height: 30px;
        }

        .iconContainor img:hover {
            cursor: pointer;
        }

        .counselorCard {
            width: 28%;
            min-width: 150px;
            height: 100%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            margin: 25px;
        }

        .counselor-image-containor {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
        }

        #counselorPhoto {
            width: 150px;
            height: 150px;
        }

        .counselorCard h4 {
            text-align: center;
        }

        .counselorCard h5 {
            text-align: center;
        }

        .counselorCard p {
            text-align: justify;
            padding-left: 30px;
            padding-right: 30px;
        }

        .conunselorCardLine {
            width: 100%;
            /* height: 500px; */
            display: flex;
            /* justify-content: center; */
            /* align-items: center; */

            flex-wrap: wrap;
        }

        .divCounselorCards {
            width: 100%;
            height: 100%;
        }

        .divExistingCounselors h3 {
            text-align: center;
        }

        .divExistingCounselors {
            width: 100%;
            height: 100%;
        }

        .main-grid .left {
            width: 100%;
            height: 700px;
        }

        /* .main-grid .right{
            flex-grow: 1;
            height: 1000px;
        } */
    </style>

</div>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    $(document).ready(function() {
        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr("data-id");
            let $this = $(this);

            // confirm delete
            if (!confirm("Are you sure you want to delete this counselor?"))
                return;

            $.ajax({
                url: `${BASE_URL}/existingCounselors/delete/${id}`,
                type: 'post',
                data: {
                    delete: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("success", response['desc'])
                        $this.closest(".counselorCard").remove();
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
    });
</script>