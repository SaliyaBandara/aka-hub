<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("manageMaterials");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left">
            <?php

            if (isset($data["course"])) {
                $img_src = USER_IMG_PATH . $data["course"]["cover_img"];
            ?>
                <!-- section header -->
                <section>
                    <div class="section_header mb-1 flex flex-column">
                        <?php
                        if ($data["role"] == 1) {
                        ?>
                            <div class="todo_item_actions flex">
                                <a href="<?= BASE_URL ?>/manageMaterials/courseEdit/add_edit/<?= $data["course"]["id"] ?>/edit" class="btn d-block m-1"> <i class='bx bx-edit'></i></a>
                                <div class="btn delete-item" data-id="<?= $data["course"]["id"] ?>">
                                    <i class='bx bx-trash text-danger'></i>
                                </div>
                            </div>
                        <?php } ?>
                        <h3 class="title font-1-5 font-semibold flex align-center text-muted">
                            &nbsp;<span class="text--black"> <?= $data["course"]["name"] ?> - <?= $data["course"]["code"] ?></span>
                        </h3>
                        <p class="title font-1-4 flex align-center text-muted">
                            &nbsp;<span class=""><?= $data["course"]["year"] ?> <?= $data["course"]["year"] == 1 ? "st " : ($data["course"]["year"] == 2 ? "nd " : ($data["course"]["year"] == 3 ? "rd " : "th ")) ?> year </span>
                            - <?= $data["course"]["semester"] ?> <?= $data["course"]["semester"] === 1 ? "st " : "nd "; ?>
                            Semester</span>
                        </p>
                        <div class="coverImageArea coverImageRow">
                            <div class="coverImage"><img src="<?= $img_src ?>" alt="No Image Uploaded"></div>
                        </div>
                        <div class="my-1">
                            <?= $data["course"]["description"] ?>
                        </div>
                        <div class="desc flex justify-between align-center">
                            <div>
                                <?php $date = new DateTime($data["course"]["updated_at"]);
                                $date = $date->format('Y F d - h:i A');
                                echo $date; ?>

                            </div>
                        </div>

                    </div>




                <?php
            } else {
                echo "<div class='font-bold'>No Course Materials Found for this module</div>";
            }
                ?>

                <a class="manageMaterialsLink" href="<?= BASE_URL ?>/manageMaterials/courses">
                    <input type="button" class="btn btn-primary my-1" value="Back To Table" />
                </a>

                <style>
                    .coverImageArea{
                        border-radius: 5px;
                        width: 70%;
                        height: auto;
                    }
                    .coverImage img{
                        border-radius: 5px;
                        width: 80%;
                        height: auto;
                    }
                    .section_header {
                        padding: 1rem;
                        border-radius: 15px;
                        background-color: #f9f9f9;
                        margin-bottom: 1rem;
                        border: 1px solid #e0e0e0;
                    }

                    .manageMaterialsLink {
                        text-decoration: none;
                    }

                    .profileButton {
                        background-color: #2d7bf4;
                        color: white !important;
                        border: none;
                    }

                    .profileButton:hover {
                        cursor: pointer;
                    }

                    .btn-blue {
                        background-color: #2d7bf4;
                        color: white !important;
                    }

                    .material-item {
                        /* border: 1px solid var(--secondary-color-faded); */
                        border-radius: 15px;
                        padding: 1.5rem;
                        max-width: 600px;
                        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
                        /* box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); */
                    }

                    .material-item .links-wrapper {
                        border: 1px solid grey;
                        border-radius: 7px;
                        /* padding-bottom: 1rem; */
                        /* box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); */
                    }

                    .material-item .links-title {
                        padding: 1rem;
                        border-bottom: 1px solid grey;
                        /* margin-bottom: 1rem; */
                    }

                    .material-item .video_links {
                        padding: 1rem;
                        padding-top: 1rem;
                        /* margin: 0.75rem; */
                        /* border-bottom: 1px solid var(--secondary-color-faded); */
                    }

                    /* first child */


                    .material-item .link-item {
                        /* padding: 0.75rem; */
                        margin-bottom: 0.25rem;
                    }

                    .material-item .link-items a {
                        background-color: #000;
                        color: #fff;
                        padding: 0.5rem;
                        width: 150px;
                        text-decoration: none;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 7px;
                    }

                    .material-item .link-items .yt-logo {
                        margin-left: 0.5rem;
                        width: 32px;
                        display: inline-block;
                    }

                    .material-item .notes-wrapper {
                        display: flex;
                        flex-wrap: wrap;
                    }

                    .material-item .note-item {
                        width: 100px;
                        height: 100px;
                        margin: 0.5rem;
                        border-radius: 7px;
                        overflow: hidden;
                        /* box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); */
                    }
                </style>

                </section>
        </div>
    </div>
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
            if (!confirm("Are you sure you want to delete this course?"))
                return;

            $.ajax({
                url: `${BASE_URL}/manageMaterials/delete_material/${id}`,
                type: 'post',
                data: {
                    delete: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        alertUser("success", response['desc'])
                        $this.closest(".material-item").remove();
                    } else if (response.status == 403)
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