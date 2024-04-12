<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("counselorFeed");
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="main-grid flex">
        <div class="left">

            <?php if ($_SESSION["user_role"] == 5) { ?>
                <div class="mb-1 form-group">
                    <a href="<?= BASE_URL ?>/counselorFeed/add_edit/0/" class="btn btn-primary">
                        <i class='bx bx-plus'></i> Add Post
                    </a>
                </div>
            <?php } ?>

            <h3 class="h3-CounselorFeed">Counselor Feed</h3>
            <div class="divFeed">
                <div class="divCounselorFeed">
                    <div class="feedContainor">

                        <?php 
                            if (empty($data["posts"])) {
                                echo '<div class = "emptyMessage"> There are no posts uploaded by you! </div>';
                            } else {
                                foreach ($data["posts"] as $posts) {
                                $img_src = USER_IMG_PATH . $posts["post_image"];
                        ?>
                                    <div class="feed-text-div">
                                        <img class="eventPost" src="<?= $img_src ?>" alt="">
                                        <!-- <img class="eventPost" src="<?= BASE_URL ?>/public/assets/user_uploads/ClubEventFeed/sample post 1.jpg" alt=""> -->
                                        <p style="white-space: pre-line;">
                                            <?= $posts["description"] ?>
                                        </p>
                                        <div class="editDeleteButton">
                                            <a href="<?= BASE_URL ?>/counselorFeed/add_edit/<?= $posts['id'] ?>"
                                            class="repDecline">
                                                <img src="<?= BASE_URL ?>/public/assets/img/icons/edit.png" alt="">
                                            </a>
                                            <a class="repDecline delete-item" data-id="<?= $posts['posted_by'] ?>">
                                                <img src="<?= BASE_URL ?>/public/assets/img/icons/delete.png" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- <div class = "electionCard">
                                        <div class = "electionCardTitle"><?= $posts["name"] ?> is happening now....</div>
                                        <div class = "electionCardTime" class="text-muted" ></div>
                                        <div class = "electionButton"><a href="<?= BASE_URL ?>/activeElection/index" class="mwb-form-submit-btn">Vote Now</a></div>
                                        <div id = "electionButton"><input type = "button" value = "VOTE NOW!"><a href=""></a></div>
                    
                                    </div> -->
                            <?php } ?>
                        <?php } ?>

                    </div>
                    <style>
                        .editDeleteButton {
                            width: 100%;
                            height: 50px;
                            display: flex;
                            justify-content: right;
                            align-items: center;
                        }

                        .eventPost {
                            width: 100%;
                            height: 570px;
                        }

                        .feed-post {
                            background-color: white;
                            width: 100%;
                            height: 850px;
                            border-radius: 5px;
                            justify-content: center;
                            display: flex;
                            margin: 0 0 100px 0;
                        }

                        .feed-text-div {
                            text-align: center;
                        }

                        .feed-text-div p {
                            text-align: justify;
                            padding: 20px;
                        }

                        .repDecline {
                            width: 15%;
                            height: 38px;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            margin-left: -10px;
                            margin-right: 13px;
                        }
                    </style>

                </div>
                <style>
                    .feedContainor {
                        width: 100%;
                        height: 100%;
                        justify-content: center;
                    }
                </style>

                <?php
                // $feedArea->render();
                ?>
            </div>
        </div>
    </div>
</div>

<style>
    .delete-item {
        cursor: pointer;
    }

    .h3-CounselorFeed {
        text-align: center;
    }

    .divFeed {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
    }

    .divCounselorFeed {
        width: 65%;
        height: 100%;
        display: flex;
        justify-content: center;
    }

    .main-grid {}

    .main-grid .left {
        width: 100%;
        height: 3000px;
    }

    /* .main-grid .right{
            flex-grow: 1;
            background-color: red;
            height: 50vh;
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
                url: `${BASE_URL}/counselorFeed/delete/${id}`,
                type: 'post',
                data: {
                    delete: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("success", response['desc'])
                        $this.closest(".feed-post").remove();
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