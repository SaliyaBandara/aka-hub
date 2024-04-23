<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("counselorFeed");
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <?php 
        $post = $data["postDetails"][0];
        $img_src = USER_IMG_PATH . $post["post_image"];
    ?>
    <div class="main-grid flex">
        <div class="left">
            <div class = "post flex justify-center flex-column align-center">
                <h2 class="postTitle mt-2"><?= $post["title"]?></h2>
                <h3 class="postTitle mt-1 mb-2 font-medium"><em> by Counselor <?= $post["name"]?></em></h3>
                <div class="postImage flex justify-center">
                    <img src="<?= $img_src ?>" alt="">
                </div>
                <div class = "postButtons flex flex-row">
                    <div class = editDelete>
                        <?php if ($_SESSION["user_role"] == 5 || $_SESSION["user_role"] == 1) { ?>
                            <div class="editDeleteButton">
                                <a href="<?= BASE_URL ?>/counselorFeed/add_edit/<?= $post['post_id'] ?>" class="repDecline">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <a class="repDecline delete-item" data-id="<?= $post['post_id'] ?>">
                                    <i class='bx bx-trash text-danger'></i>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <div style = "width: 50%;"></div>
                    <div class= "likes">
                        <?php 
                            $likedToPost = false;

                            if(!empty($data['liked'])){
                                $likedToPost = true;
                            }

                            $heartIconClass = $likedToPost ? "bx bxs-heart text-danger likeButton" : "bx bx-heart likeButton text-danger likeButton";

                        ?>
                        
                        <a class = "likePost" data-id = "<?= $post["id"] ?>">
                            <i class= "<?= $heartIconClass ?>"></i>
                        </a>
                        <label class = "likeCountLabel font-medium">
                            <?= ($post['likesCount'] === null) ? '0 Likes' : $post['likesCount'] . ' Likes' ?>
                        </label>
                    </div>
                </div>
                <div class="postContent">
                    <p style="white-space: pre-line;" ><?= $post["description"]?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .postButtons{
        /* border: 1px solid red; */
        width: 60%;
        margin: 1rem;
        border-radius: 10px;
        border: 1px solid #d0d0d0;
    }

    .postImage img{
        width: 70%;
        height: 70%;
        border-radius: 10px;
    }

    .postContent{
        padding: 1rem 3rem 1rem 3rem;
    }

    .main-grid {
    }

    .main-grid .left {
        width: 100% !important;
        height: 3000px;
    }

    .editDelete {
        display: flex;
        justify-content: left;
        /* border: 1px solid red; */
        padding: 1rem;
        font-size: 20px;
        width: 20%;
    }

    
    .editDelete a{
        text-decoration: none;
        color: inherit;
        margin-left: 5px;
        font-size: 28px;
    }

    .likes{
        display: flex;
        justify-content: right;
        /* border: 1px solid red; */
        font-size: 20px;
        padding: 1rem;
        width: 30%;
    }

    .likes a{
        font-size: 28px;
        margin-right: 5px;
        text-decoration: none;
        color: inherit;
        cursor: pointer;

    }

     .likeCountLabel {
        font-size: 20px;
        padding-top: 4px;
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
                url: `${BASE_URL}/counselorFeed/delete/${id}`,
                type: 'post',
                data: {
                    delete: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("success", response['desc'])
                        window.location.href = document.referrer;
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