<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();

if($_SESSION["user_role"] == 1){
    $sidebar = new Sidebar("feedsSelection");
}
else{
    $sidebar = new Sidebar("eventFeed");
}

?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="main-grid flex">
        <div class="left">
            <?php if ($_SESSION["club_rep"]) { ?>
                <div class="mb-1 form-group switchButton">
                    <a href="<?= BASE_URL ?>/eventFeed/add_edit/0/" class="btn btn-primary">
                        <i class='bx bx-plus'></i> Add Post
                    </a>
                </div>
                <div class="mb-1 form-group switchButton">
                    <a href="<?= BASE_URL ?>/eventFeed/<?= $data["link"]?>" class="btn btn-primary">
                        <i class='bx <?= $data["iClass"] ?>'></i> <?= $data["buttonValue"]?>
                    </a>
                </div>
            <?php } ?>
            <?php 
                if($data["filter"] == 1){
            ?>
                <select id="club" name="club" placeholder="Select Your Club/Society" data-validation="required" class="form-control my-2">
                    <?php 
                        if (empty($data["clubs"])) {
                            echo "<option value = '' class='font-medium text-muted'> There are no excisting clubs </option>";
                        } else {
                            echo "<option selected value=''> Select your club/society </option>";
                            foreach ($data["clubs"] as $club) {        
                                echo "<option value='{$club['id']}'>{$club['name']}</option>";
                            }
                        }
                    ?>
                </select>
            <?php } ?>
            <h3 class="h3-CounselorFeed"><?= $data["topic"] ?></h3>
            <div class="divFeed">
                <div class="divCounselorFeed">
                    <div class="feedContainer">

                        <?php 
                            if (empty($data["posts"])) {
                                echo "<div class='font-meidum text-muted'> No posts found! </div>";
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
                                                        <?= date('d/m/y H:i', strtotime($posts["updated_datetime"])) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = detailsRight>
                                                <?php if (($_SESSION["club_rep"] && ($posts['posted_by'] == $_SESSION["user_id"])) || $_SESSION["user_role"] == 1) { ?>
                                                    <div class="editDeleteButton">
                                                        <a href="<?= BASE_URL ?>/eventFeed/add_edit/<?= $posts['id'] ?>" class="repDecline">
                                                            <i class='bx bx-edit'></i>
                                                        </a>
                                                        <a class="repDecline delete-item" data-id="<?= $posts['id'] ?>">
                                                            <i class='bx bx-trash text-danger'></i>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class = "postTitle my-1 font-bold"> <?= strtoupper($posts["title"]) ?></div> 
                                        <img class="postImage" src="<?= $img_src ?>" alt="">
                                        <div class = "postTitle font-bold mt-1 mx-1" style = "text-align:right !important; ">
                                            <?php 
                                                $club = " ";

                                                foreach ($data["clubReps"] as $clubRep) {
                                                    if ($clubRep['user_id'] == $posts['posted_by']) {
                                                        // Output the comment content directly
                                                        $club = $clubRep["name"];
                                                    }
                                                }
                                            ?>
                                            <em>Posted by : <?= $club ?></em>
                                        </div>
                                        <!-- <img class="eventPost" src="<?= BASE_URL ?>/public/assets/user_uploads/ClubEventFeed/sample post 1.jpg" alt=""> -->
                                        <div style="white-space: pre-line; text-align:left;" class = "mx-1">
                                            <?= substr($posts["description"], 0, 500) . (strlen($posts["description"]) > 500 ? '...' : '') ?>
                                        </div>
                                        
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
                                                    <a href="#" id="commentsToggle">
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
        <div class = "right">
            <div class = "flex-column justify-center align-center divButtonSection">
                <div class = "title font-1-5 font-bold flex align-center justify-center requestDescription">
                    Are you engaged in any club/society in the university?
                </div>
                <div class = "title font-1 font-medium flex align-left justify-center requestDescription">
                    Become a Representative for your club/society and spread the word abuot your events!
                </div>
                <div class="mb-1 form-group">
                    <div>
                        <form action="" method="post" class="form">
                            <div class="mb-1 form-group">
                                <label for="name" class="form-label">
                                    Club Name
                                </label>
                                <select id="name" name="name" placeholder="Select Your Club/Society" data-validation="required" class="form-control">
                                <?php 
                                    if (empty($data["clubs"])) {
                                        echo "<option value='' class='font-medium text-muted'>No clubs available</option>";
                                    } else {
                                        echo "<option selected value=''> Select your club/society </option>";
                                        foreach ($data["clubs"] as $club) {        
                                            echo "<option value='{$club['id']}'>{$club['name']}</option>";
                                        }
                                    }
                                ?>
                                </select>
                            </div>

                            <div href="#">
                                <div class = "btn btn-primary mb-1 form form-group clubRequestButton justify-center align-center">
                                    Send Request
                                </div>
                            </div>
                        </form>
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

    .switchButton{
        display: inline !important;
        margin-right: 1rem !important;
    }

    .userDetails{
        display: flex;
        flex-direction: column;
        padding-left: 1rem;
        /* border: 1px solid red; */
        justify-content: center;
    }

    .detailsRight{ width: 30%;}

    /* .textBox, .addCommentButton{
        width: 50% !important;
    } */

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
        border: 1px solid #d0d0d0;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius : 20px;
        /* margin: 25px; */
    }

    .feedPost p {
        text-align: justify;
        padding: 20px 20px 0 20px;
    }

    .postTitle{
        padding-left: 1rem;
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
        width: 80%;
        height: 100%;
        display: flex;
        justify-content: center;
        /* margin: 0 !important;
        border: 1px solid red; */
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

    .main-grid {
    }

    .main-grid .left {
        width: 65% !important;
        height: 3000px;
    }

    .main-grid .right {
        width: 35% !important;
        height: 3000px;
        margin-top: 6rem !important;
        /* border: 1px solid red; */
    }

    .divButtonSection{
        border-radius: 10px;
        margin:1rem;
        /* border: 1px solid red; */
        justify-content: center;
        padding:1rem;
    }


    .teachingRequestButton{
        border: 1px solid #2684ff;
        background-color: var(--secondary-color);
        color: white;
        width: 100%;
        text-align:center;
        text-decoration: none !important;
    }

    .divButtonSection a{
        text-decoration: none !important;
    }
    
    .requestDescription{
        text-align: center;
        width : 100%;
        /* border:1px solid red; */
        padding-bottom: 1rem;
        color: black;
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

</style>

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
            if (!confirm("Are you sure you want to delete this post?"))
                return;

            $.ajax({
                url: `${BASE_URL}/eventFeed/delete/${id}`,
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
                url: `${BASE_URL}/eventFeed/like/${id}`,
                type: 'post',
                data: {
                    like: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("danger", response['desc'])

                        let $countLabel = $this.closest('.likeCommentButton').find('.likeCountLabel');
                        let currentCountText = $countLabel.text().trim();
                        let currentCount = parseInt(currentCountText.split(' ')[0]);
                        $countLabel.text((currentCount + 1) + ' Likes');

                        $this.closest('.likePost').find('i').removeClass('bx bx-heart text-danger likeButton').addClass('bx bxs-heart text-danger likeButton');

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

        $(document).on("click", ".clubRequestButton", function() {

            let selectedValue = $("#name").val();

            $.ajax({
                url: `${BASE_URL}/eventFeed/clickToBeClubRep/${selectedValue}`,
                type: 'post',
                data: {
                    request: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("success", response['desc'])
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
                url: `${BASE_URL}/eventFeed/postComment/${postId}`,
                type: 'post',
                data: {
                    request: true,
                    comment : comment
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("success", response['desc'])

                        let $commentCountLabel = $(`#${postId}`).closest(".feedPost").find("#commentCount");
                        let currentCount = parseInt($commentCountLabel.text().trim().split(' ')[0]);
                        $commentCountLabel.text((currentCount + 1) + ' Comments');

                        $(`#${postId}`).closest(".feedPost").find(".textBox").val("");

                        refreshComments(postId);

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
                url: `${BASE_URL}/eventFeed/deleteComment/${id}`,
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

        $(document).on("change", "#club", function() {

            let selectedValue = $("#club").val();

            $.ajax({
                url: `${BASE_URL}/eventFeed/filter`,
                type: 'post',
                data: {
                    club_id: selectedValue
                },
                success: function(data) {
                    if (data) {
                        $('.feedContainer').html(data); // Update the content of .feedContainer
                    } else {
                        // Handle empty or invalid response
                        alertUser("warning", "No posts found for the selected club.");
                    }
                },
                error: function(ajaxContext) {
                    alertUser("danger", "Something Went Wrong");
                }
            });
        });

        function refreshComments(postId) {
            let $commentsSection = $(`#${postId}`).closest(".feedPost").find("#commentsSection");

            // Send AJAX request to fetch updated comments
            $.ajax({
                url: `${BASE_URL}/eventFeed/getComments`,
                type: 'post',
                data: {
                    postId: postId
                },
                success: function(data) {
                    // Replace the content of commentsSection with the updated comments
                    $commentsSection.html(data);
                },
                error: function(ajaxContext) {
                    alertUser("danger", "Failed to refresh comments");
                }
            });
        }
    });
</script>