<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("existingCounselors");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <!-- <div class="left"> -->
        <div class="divExistingCounselors">
            <div class="section_header mb-1 flex">
                <div class="title font-1-5 font-semibold flex align-center">
                    <i class='bx bxs-calendar-check me-0-5'></i> Existing Counselors
                </div>
            </div>
            <div class="divCounselorCards">
                <div class="conunselorCardLine">
                    <?php
                    if (is_array($data["counselors"])) {

                        foreach ($data["counselors"] as $key => $value) {

                            $img_src_profile = USER_IMG_PATH . $value["profile_img"];

                            if ($value["role"] == 5) {
                                echo "<div class='counselorCard'>";
                                if ($value["type"] == 1) {
                                    echo "<h4>Professional Counselor</h4>";
                                } else {
                                    echo "<h4>Student Counselor</h4>";
                                }
                                echo "<div class='counselor-image-containor'>";
                                echo "<img src='$img_src_profile' alt='' id = 'counselorPhoto'>";
                                echo "</div>";
                                echo "<h5>" . $value["name"] . "</h5>";
                                echo "<h5>" . $value["email"] . "</h5>";
                                echo "<h5> 0" . $value["contact"] . "</h5>";

                                //if user is a student 
                                echo "<div class = 'detailsButtonArea'>";
                                echo "<a href='./counselorView/index/{$value['id']}'>";
                                echo "<div class = 'btn btn-primary mb-1 form form-group  detailsButton justify-center align-center'>";
                                echo "View Details";
                                echo "</div>";
                                echo "</a>";
                                echo "</div>";


                                // echo "<p>".$value["description"]."</p>";
                                //if user is an admin
                                if ($data["role"] == 1) {
                                    echo "<div class='edit-delete-containor'>";
                                    echo "<a href='" . BASE_URL . "/addCounselors/index/" . $value["id"] . "' class='block iconContainor'>";
                                    echo "<i class='bx bx-edit'></i>";
                                    echo "</a>";
                                    echo "<div class='iconContainor delete-item' data-id='" . $value["id"] . "'>";
                                    echo "<i class='bx bx-trash text-danger'></i>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                        }
                    }

                    ?>
                </div>

                <?php if ($data["role"] == 1) { ?>
                    <div class="buttonDivToAddCounselors">
                        <div class="gotoAddCounselor">
                            <div>
                                <a href="<?= BASE_URL ?>/addCounselors/index/0" class="mwb-form-submit-btn">Add Counselor</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- <div class="buttonDivToAddCounselors">
                    <div class="gotoAddCounselor">
                        <div>
                            <a href="<?= BASE_URL ?>/addCounselors/index/0" class="mwb-form-submit-btn">Add Counselor</a>
                        </div>
                    </div>
                </div> -->

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

        .edit-delete-containor a,
        .delete-item {
            text-decoration: none;
            color: inherit;
            margin-left: 5px;
            font-size: 20px;
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
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
            margin: 25px;
            border-radius: 10px;
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

        .detailsButtonArea {
            width: 100%;
            /* border: 1px solid red; */
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .detailsButtonArea a {
            text-decoration: none;
        }

        /* 
        .detailsButton{
            width: 50%;
            border: 1px solid red;
            justify-content: center ;
            align-items: center ;
            text-align: center;
        } */

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
            padding: 31px;
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