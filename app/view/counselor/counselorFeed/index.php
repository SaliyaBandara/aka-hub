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
                    <div class="feedContainer">

                        <?php 
                            if (empty($data["posts"])) {
                                echo "<div class='font-meidum text-muted'>You can publish an article using 'Add Post' button above!</div>";
                            } else {
                                foreach ($data["posts"] as $posts) {
                                $img_src = USER_IMG_PATH . $posts["post_image"];
                                $img_src_profile = USER_IMG_PATH . $data["user"]["profile_img"];
                        ?>
                                    <div class="feedPost my-2">
                                        <div class = "postDetails">
                                            <div class = "detailsLeft">
                                                <div class = "userImage">
                                                    <img src="<?= $img_src_profile ?>" alt="">
                                                </div>
                                                <div class = "userDetails">
                                                    <div class = "userName">
                                                        <?= $_SESSION["user_name"] ?>
                                                    </div>
                                                    <div class = "publishedDate">
                                                        <?= date('d/m/y H:i', strtotime($posts["created_datetime"])) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = detailsRight>
                                                <div class="editDeleteButton">
                                                    <a href="<?= BASE_URL ?>/counselorFeed/add_edit/<?= $posts['id'] ?>" class="repDecline">
                                                        <i class='bx bx-edit'></i>
                                                    </a>
                                                    <a class="repDecline delete-item" data-id="<?= $posts['id'] ?>">
                                                        <i class='bx bx-trash text-danger'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "postTitle my-1 font-medium"> <?= strtoupper($posts["title"]) ?></div> 
                                        <img class="postImage" src="<?= $img_src ?>" alt="">
                                        <!-- <img class="eventPost" src="<?= BASE_URL ?>/public/assets/user_uploads/ClubEventFeed/sample post 1.jpg" alt=""> -->
                                        <p style="white-space: pre-line;">
                                            <?= substr($posts["description"], 0, 500) . (strlen($posts["description"]) > 500 ? '...' : '') ?>
                                        </p>
                                        <div class = "postDetails">
                                            <div class = "detailsLeft">
                                                <div class="likeCommentButton">
                                                    <!-- <a href="./counselorFeed/like/<?= $posts["id"] ?>"> -->
                                                    <a class = "likePost" data-id = "<?= $posts["id"] ?>">
                                                        <i class='bx bx-heart text-danger likeButton'></i>
                                                    </a>
                                                    <label class = "likeCountLabel">
                                                        <?= ($posts['likesCount'] === null) ? '0 Likes' : $posts['likesCount'] . ' Likes' ?>
                                                    </label>
                                                    <a href = "#" class="commentsToggle">
                                                        <i class='bx bx-message-rounded'></i>
                                                    </a> 
                                                    <label>
                                                        <!-- <?= count($data["comments"]) ?>  -->
                                                        2 Comments
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="commentsSection" style="display: none;">
                                            <?php 
                                                if (empty($data["comments"])) {
                                                    echo "<div class='font-meidum text-muted'></div>";
                                                } else {
                                                    foreach ($data["comments"] as $comments) {
                                            ?>
                                                <p><?= $comments["comment"] ?></p>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .postDetails{
        /* border: 1px solid black; */
        width: 100%;
        display: flex;
        flex-direction: row;
    }

    .detailsLeft{
        /* border: 1px solid red; */
        width: 70%;
        display: flex;
        flex-direction:row;
        padding: 1rem;
    }

    .userDetails{
        display: flex;
        flex-direction: column;
        padding-left: 1rem;
        /* border: 1px solid red; */
        justify-content: center;
    }

    .detailsRight{ width: 30%;}

    .editDeleteButton {
        display: flex;
        justify-content: right;
        /* border: 1px solid red; */
        padding: 1rem;
        font-size: 20px;
    }

    
    .editDeleteButton a{
        text-decoration: none;
        color: inherit;
        margin-left: 5px;
    }

    .likeCommentButton{
        display: flex;
        justify-content: right;
        /* border: 1px solid red; */
        font-size: 20px;
    }

    .likeCommentButton a{
        font-size: 28px;
        margin-right: 5px;
        text-decoration: none;
        color: inherit;
    }

    .likeCommentButton label{
        font-size: 12px;
        margin-right: 25px;
        padding-top: 10px;
    }

    .userName , .publishedDate{
        font-size: 12px;
    }

    .feedContainor {
        width: 100%;
        height: 100%;
        justify-content: center;
    }

    .divFeed{
        /* border: 1px solid red; */
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
    }



    .postImage {
        width: 100%;
        height: auto;
        /* border: 1px solid blue; */
    }

    .feedPost {
        text-align: center;
        /* border: 1px solid black; */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        border-radius : 20px;
        /* margin: 25px; */
    }

    .feedPost p {
        text-align: justify;
        padding: 20px 20px 0 20px;
    }

    .postTitle{
        padding-top: 15px;
        padding-left: 15px;
        text-align: left;
        /* font-weight: bold; */
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
    .delete-item, .likePost{
        cursor: pointer;
    }

    .h3-CounselorFeed {
        text-align: center;
    }

    .divCounselorFeed {
        width: 65%;
        height: 100%;
        display: flex;
        justify-content: center;
    }

    .userImage{
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        border: 2px solid #bdd2f1;
        width: 3rem;
        height: 3rem;
        overflow: hidden;
    }

    .userImage img{
        width: 6rem;
        height: 6rem;
        display: block;
    }

    .main-grid {
    }

    .main-grid .left {
        width: 100%;
        height: 3000px;
    }
</style>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Select all elements with the class 'commentsToggle'
        const toggleButtons = document.querySelectorAll(".commentsToggle");

        // Iterate over each toggle button
        toggleButtons.forEach(function(toggleButton) {
            // Add click event listener to each toggle button
            toggleButton.addEventListener("click", function(event) {
                event.preventDefault();
                // Find the corresponding comments section based on the button's parent element
                const commentsSection = toggleButton.closest(".postDetails").nextElementSibling;
                // Toggle the display style of the comments section
                commentsSection.style.display = commentsSection.style.display === "none" ? "block" : "none";
            });
        });
    });

</script> -->
<script>
    $(document).ready(function() {
        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr("data-id");
            let $this = $(this);

            // confirm delete
            if (!confirm("Are you sure you want to delete this post?"))
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
                        $this.closest(".feedPost").remove();
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

        $(document).on("click", ".likePost", function() {
            let id = $(this).attr("data-id");
            let $this = $(this);

            // // confirm delete
            // if (!confirm("Are you sure you want to delete this post?"))
            //     return;

            $.ajax({
                url: `${BASE_URL}/counselorFeed/like/${id}`,
                type: 'post',
                data: {
                    like: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("danger", response['desc'])
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    } else if (response['status'] == 403)
                        alertUser("danger", response['desc'])
                    else
                        alertUser("warning", response['desc'])
                },
                error: function(ajaxContext) {
                    alertUser("danger", "You have already liked this post")
                }
            });
        });
    });
</script>