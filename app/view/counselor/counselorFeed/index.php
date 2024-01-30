<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("counselorFeed");
$feedArea = new feedArea();
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

                        <!-- <div class="feed-post"> -->
                        <!-- <div class="feed-text-div">
                                <img class="eventPost" src="<?= BASE_URL ?>/public/assets/user_uploads/ClubEventFeed/sample post 1.jpg" alt="">
                                <p>Gratitude should be paid where it's due…</br>

                                    Our sense of obligation extends towards our distinguished member speakers and the wonderful audience in making this event, a grand success.</br>

                                    We sincerely thank the participants for valuing our efforts and for having been a great audience.</br>

                                    Until we meet again, au revoir…</br>

                                    #ACM #UCSC #ACMSCUCSC</p>
                                <div class="editDeleteButton">
                                    <div class="repEdit">
                                        <img src="<?= BASE_URL ?>/public/assets/img/icons/edit.png" alt="">
                                    </div>
                                    <div class="repDecline">
                                        <img src="<?= BASE_URL ?>/public/assets/img/icons/delete.png" alt="">
                                    </div>
                                </div>
                            </div> -->

                        <?php


                        // Array
                        // (
                        //     [0] => Array
                        //         (
                        //             [id] => 1
                        //             [user_id] => 9
                        //             [title] => 
                        //             [description] => Test
                        //             [image] => course_cover_202311010814186541bb820eba100603290016988066581345.jpg
                        //             [created_at] => 2023-11-01 08:09:36
                        //             [updated_at] => 2023-11-01 08:09:36
                        //         )

                        //     [1] => Array
                        //         (
                        //             [id] => 2
                        //             [user_id] => 9
                        //             [title] => 
                        //             [description] => Gratitude should be paid where it's due…
                        // Our sense of obligation extends towards our distinguished member speakers and the wonderful audience in making this event, a grand success.
                        // We sincerely thank the participants for valuing our efforts and for having been a great audience.
                        // Until we meet again, au revoir…
                        // #ACM #UCSC #ACMSCUCSC test
                        //             [image] => course_cover_202311010810426541baaa5932003653490016988064426534.png
                        //             [created_at] => 2023-11-01 08:11:12
                        //             [updated_at] => 2023-11-01 08:11:12
                        //         )

                        // )

                        // if (is_array($data['posts'])) {

                        //     foreach ($data['posts'] as $key => $value) {
                        //         $description = $value['description'];
                        //         // $description = substr($description, 0, 200);
                        //         $img = BASE_URL . "/public/assets/user_uploads/img/" . $value['image'];

                        // ?>
                        //         <div class="feed-post">
                        //             <div class="feed-text-div">
                        //                 <img class="eventPost" src="<?= $img ?>" alt="">
                        //                 <!-- <img class="eventPost" src="<?= BASE_URL ?>/public/assets/user_uploads/ClubEventFeed/sample post 1.jpg" alt=""> -->
                        //                 <p style="white-space: pre-line;">
                        //                     <?= $description ?>
                        //                 </p>
                        //                 <div class="editDeleteButton">
                        //                     <a href="<?= BASE_URL ?>/counselorFeed/add_edit/<?= $value['id'] ?>"
                        //                     class="repEdit">
                        //                         <img src="<?= BASE_URL ?>/public/assets/img/icons/edit.png" alt="">
                        //                     </a>
                        //                     <a class="repDecline delete-item" data-id="<?= $value['id'] ?>">
                        //                         <img src="<?= BASE_URL ?>/public/assets/img/icons/delete.png" alt="">
                        //                     </a>
                        //                 </div>
                        //             </div>
                        //         </div>

                        // <?php


                        //     }
                        // }


                        ?>
                        <!-- <img src="https://cdn-icons-png.flaticon.com/512/5508/5508714.png" alt=""> -->

                    </div>
                    <style>
                        .repEdit {
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            width: 50px;
                        }

                        .repDecline {
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            width: 50px;
                        }

                        .repEdit img {
                            width: 35px;
                            height: 35px;
                        }

                        .repDecline img {
                            width: 35px;
                            height: 35px;
                        }

                        .repEdit img:hover {
                            width: 67px;
                            height: 67px;
                            cursor: pointer;
                        }

                        .repDecline img:hover {
                            width: 37px;
                            height: 37px;
                            cursor: pointer;
                        }

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