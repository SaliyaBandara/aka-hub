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
            <div class="divFeed flex justify-center">
                <div class="divCounselorFeed">
                    <div class="feedContainer">

                        <?php 
                            if (empty($data["posts"])) {
                                echo "<div class='font-meidum text-muted'>You can publish an article using 'Add Post' button above!</div>";
                            } else {
                                foreach ($data["posts"] as $posts) {
                                $img_src = USER_IMG_PATH . $posts["post_image"];
                                $img_src_profile = USER_IMG_PATH . $posts["profile_img"];
                        ?>
                                
                                    <div class="feedPost my-2">
                                        <div class = "postDetails">
                                            <div class = "detailsLeft">
                                                <div class = "userImage">
                                                    <img src="<?= $img_src_profile ?>" alt="">
                                                </div>
                                                <div class = "userDetails">
                                                    <div class = "userName">
                                                        <?= $posts["name"] ?>
                                                    </div>
                                                    <div class = "publishedDate">
                                                        <?= date('d/m/y H:i', strtotime($posts["created_datetime"])) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = detailsRight>
                                                <?php if ($_SESSION["user_role"] == 5 || $_SESSION["user_role"] == 1) { ?>
                                                    <div class="editDeleteButton">
                                                        <a href="<?= BASE_URL ?>/counselorFeed/add_edit/<?= $posts['id'] ?>" class="repDecline">
                                                            <i class='bx bx-edit'></i>
                                                        </a>
                                                        <a class="repDecline delete-item" data-id="<?= $posts['id'] ?>">
                                                            <i class='bx bx-trash text-danger'></i>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class = "postTitle my-1 font-medium"> <?= strtoupper($posts["title"]) ?></div> 
                                        <img class="postImage" src="<?= $img_src ?>" alt="">
                                        
                                        <p style="white-space: pre-line;">
                                            <?= substr($posts["description"], 0, 500) . (strlen($posts["description"]) > 500 ? '...' : '') ?>
                                        </p>
                                        <a href = "<?= BASE_URL ?>/counselorFeed/postView/<?= $posts['id']?>" style = "text-decoration: none !important; color: inherit;"> 
                                            <div class = "flex justify-left mx-1 font-bold text-secondary"> <em> Read More... </em> </div>
                                        </a>
                                        <div class = "postDetails">
                                            <div class = "detailsLeft">
                                                <div class="likeCommentButton">

                                                    <?php 
                                                        $likedToPost = false;

                                                        foreach($data['liked'] as $liked){
                                                            if($liked['post_id'] == $posts['id']){
                                                                $likedToPost = true;
                                                                break;
                                                            }
                                                        }

                                                        $heartIconClass = $likedToPost ? "bx bxs-heart text-danger likeButton" : "bx bx-heart likeButton text-danger likeButton";

                                                    ?>
                                                   
                                                    <a class = "likePost" data-id = "<?= $posts["id"] ?>">
                                                        <i class= "<?= $heartIconClass ?>"></i>
                                                    </a>
                                                    <label class = "likeCountLabel">
                                                        <?= ($posts['likesCount'] === null) ? '0 Likes' : $posts['likesCount'] . ' Likes' ?>
                                                    </label>
                                                    <a href = "#" id="commentsToggle">
                                                        <i class='bx bx-message-rounded'></i>
                                                    </a> 
                                                    <?php
                                                        $postIdToFind = $posts['id'];
                                                        $hasComments = false; // Flag to track if comments exist for the post
                                                        $count = 0;

                                                        foreach ($data['comments'] as $comment) {
                                                            if ($comment['post_id'] == $postIdToFind) {
                                                                // Output the comment content directly
                                                                $count = $count + 1;
                                                            }
                                                        }

                                                        // If no comments were found, display a message
                                                    ?>
                                                    <label id = "commentCount">
                                                        <?= $count ?> Comments
                                                    </label> 
                                                </div>
                                            </div>
                                        </div>
                                        <div id="commentsSection" style="display: none;" class = "my-2">
                                            <div class = "font-medium font-1 text-left mx-1"> Comments </div>
                                            
                                            <?php
                                                
                                                $postIdToFind = $posts['id'];
                                                $hasComments = false; // Flag to track if comments exist for the post

                                                foreach ($data['comments'] as $comment) {
                                                    if ($comment['post_id'] == $postIdToFind) {
                                                        // Output the comment content directly
                                                    $img_src_comment = USER_IMG_PATH . $comment["profile_img"];
                                            ?>
                                                    
                                                    <div class = "commentContent flex flex-row">
                                                        <div class = "userImageComment">
                                                            <img src="<?= $img_src_comment ?>" alt="">
                                                        </div>
                                                        <div class = "flex flex-column justify-center">
                                                            <div class = "text-medium mx-0-5 flex" style = "font-size: 9px;"><?= $comment['name']?></div>
                                                            <div class = "text-medium font-1 mx-0-5 flex"> <?= $comment['comment']?> </div>
                                                        </div>
                                                        
                                                        <?php 
                                                            if($comment["user_id"] == $_SESSION["user_id"] || $comment["posted_by"] == $_SESSION["user_id"] || $_SESSION["user_role"] == 1){
                                                                // echo '<div class = "text-medium font-1 mx-1 my-1"> <i class="bx bx-edit"></i> </div>';
                                                                echo '<div class = "text-medium mx-0-5 text-danger flex justify-center align-center deleteComment" style = "font-size: 18px; cursor: pointer;" data-id = "'.$comment['id'].'"> <i class="bx bx-trash"></i> </div>';
                                                            }
                                                        ?>
                                                        
                                                    </div>
                                                        
                                            <?php        
                                                        $hasComments = true; // Set flag to true as comments exist
                                                    }
                                                }

                                                // If no comments were found, display a message
                                                if (!$hasComments) {
                                                    echo '<div class = "text-muted font-medium mx-1 my-1 font-1" style = "text-align: left;">No comments to show</div>';
                                                }
                                            ?>                                                           
                                        </div>
                                        <hr></hr>
                                        <div class = "addCommentSection my-1 form-group">
                                            <div>
                                                <form action="" method="post" class="form">
                                                    <div class= "flex flex-row">
                                                        <div class="mb-1 ms-1 form-group">
                                                            <label for="name" class="form-label" style = "text-align: left !important;">
                                                                Add new comment
                                                            </label>
                                                            <input type="text" id="newComment" name="newComment" class="form-control textBox" placeholder="Enter comment" value = ""  data-validation="required">
                                                        </div>

                                                        <div href="#" class="my-0-5">
                                                            <div class = "btn btn-primary mb-1 mx-1 my-1 addCommentButton" id = <?= $posts["id"]?>>
                                                                Post
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
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

    .userImageComment{
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        width: 2.25rem;
        height: 2.25rem;
        overflow: hidden;
        margin-right: 0.5rem;
    }

    .userImageComment img{
        width: 4rem;
        height: 4rem;
        display: block;
    }

    #commentsSection {
        /* border: 1px solid red; */
        padding-bottom: 2rem !important;
    }

    .commentContent {
        margin: 0.5rem 0 0 2rem;
        padding: 8px;
        border-radius: 20px; /* Use Arial font or fallback to sans-serif */
        color: #333; /* Dark text color */
        /* background-color: #ffffff; */
        /* border: 1px solid black; */
        /* opacity: 70%; */
        width: 50%;
        /* box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1); */
        text-align: left;
    }

    .main-grid {
    }

    .main-grid .left {
        width: 100% !important;
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

        $(document).on("click","#commentsToggle",function() {

            var $postContainer = $(this).closest('.feedPost');
            var $commentsSection = $postContainer.find('#commentsSection');
            $commentsSection.toggle();

        });

        $(document).on("click", ".addCommentButton", function() {

            var postId = $(this).attr("id");
            var comment = $(this).closest(".feedPost").find(".textBox").val();
            console.log(comment);

            // comment = encodeURIComponent(comment);

            $.ajax({
                url: `${BASE_URL}/counselorFeed/postComment/${postId}/${comment}`,
                type: 'post',
                data: {
                    request: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("success", response['desc'])
                        setTimeout(function() {
                            location.reload();
                        }, 500);

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

        $(document).on("click", ".deleteComment", function() {
            let id = $(this).attr("data-id");
            let $this = $(this);

            // confirm delete
            if (!confirm("Are you sure you want to delete this comment?"))
                return;

            $.ajax({
                url: `${BASE_URL}/counselorFeed/deleteComment/${id}`,
                type: 'post',
                data: {
                    delete: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("success", response['desc'])
                        $this.closest(".commentContent").remove();
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