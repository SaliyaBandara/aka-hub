<?php
$HTMLHead = new HTMLHead($data['title']);
$sidebar = new Sidebar("forum");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left w-100">

            <!-- section header -->
            <section>

                <div class="forum-header">
                    <div class="section_header mb-1 flex justify-between">
                        <a href="<?= BASE_URL ?>/forum/" class="btn btn-primary">
                            <i class='bx bx-arrow-back'></i> Back to Forum
                        </a>
                    </div>
                </div>

                <div class="forum-flex">

                    <div class="forum-posts">

                        <?php

                        // print_r($data['items']);
                        // die;

                        foreach ($data['item'] as $key => $value) {
                            $img = USER_IMG_PATH . $value['image'];
                            $value['created_at'] = date("d M Y", strtotime($value['created_at']));

                            $user_img = USER_IMG_PATH . $value['user']['profile_img'];

                            // get user year with suffix
                            $suffixes = ["st", "nd", "rd", "th"];

                            $year = $value['user']['year'] . "th Year Student";
                            if ($value['user']['year'] < 4)
                                $year = $value['user']['year'] . $suffixes[$value['user']['year'] - 1] . " Year Student";

                        ?>

                            <div class="post-item" data-id="<?= $value['id'] ?>">
                                <div class="user-details">
                                    <div class="profile-img">
                                        <img src="<?= $user_img ?>" alt="profile">
                                    </div>
                                    <div class="user-name font-semibold">
                                        <?= $value['user']['name'] ?><br />
                                        <span class="font-0-8"><?= $year ?></span>
                                    </div>
                                    <div class="spacer"></div>
                                    <div class="date-time"><?= $value['created_at'] ?></div>
                                </div>
                                <div class="post-content">
                                    <div class="post-title"><?= $value['title'] ?></div>
                                    <div class="post-desc"><?= $value['content'] ?></div>
                                    <?php if ($value['image'] != "") { ?>
                                        <div class="post-img">
                                            <img src="<?= $img ?>" alt="post image">
                                        </div>
                                    <?php } ?>
                                    <div class="post-actions">
                                        <div class="action-item">
                                            <i class='bx bx-comment'></i> 5
                                        </div>
                                        <!-- <div class="action-item">
                                            <i class='bx bx-share'></i> 3
                                        </div> -->
                                    </div>
                                </div>

                                <div class="new-comment-box">
                                    <input type="text" id="new_comment" name="new_comment" placeholder="Add a comment" value="" data-validation="required" class="form-control">
                                    <button type="submit" class="btn btn-primary new-comment-btn">Comment</button>
                                </div>

                                <style>
                                    .new-comment-box {
                                        margin-top: 1rem;
                                        display: flex;
                                    }

                                    .new-comment-box button {
                                        margin-left: 0.5rem;
                                    }
                                </style>

                                <div class="post-comments">

                                    <hr />
                                    <h3>Comments</h3>
                                    <ol class="comments">
                                        <?php
                                        function generateCommentHtml($comments)
                                        {
                                            $html = '';
                                            foreach ($comments as $comment) {

                                                $has_replies = !empty($comment['replies']) ? 'has-replies' : '';


                                                $html .= '<li class="' . $has_replies . '">
                                                <article class="comment" data-id="' . $comment['id'] . '">
                                                <aside class="avatar">
                                                <img src="' . USER_IMG_PATH . $comment['user']['profile_img'] . '" alt="' . $comment['user']['name'] . '">
                                                <div class="name">' . $comment['user']['name'] . '</div>
                                                </aside>
                                                <div class="comment-content">' . $comment['content'] . '</div>
                                                <div class="reply">
                                                <a href="#reply" title="Reply to this comment">+</a>
                                                </div>';
                                                $html .= '</article>';


                                                if (!empty($comment['replies'])) {
                                                    $html .= '<ol class="replies">';

                                                    // Recursively generate replies
                                                    $html .= generateCommentHtml($comment['replies']);
                                                    $html .= '</ol>';
                                                }


                                                echo '</li>';
                                            }

                                            return $html;
                                        }

                                        foreach ($data['item'] as $value) {
                                            if (!empty($value['comments'])) {
                                                echo generateCommentHtml($value['comments']);
                                            }
                                        }
                                        ?>
                                    </ol>
                                </div>
                            </div>


                            <style>
                                .post-comments hr {
                                    background: none;
                                    border: none;
                                    width: 100%;
                                    margin: 0;
                                    border-top: 1px solid #ccc;
                                }

                                .post-comments {
                                    /* max-width: 720px; */
                                    border-radius: 5px;
                                    padding: 0;
                                    margin-top: 20px;
                                    /* box-shadow: 0 0 20px rgba(0, 0, 0, .2), 0 5px 5px rgba(0, 0, 0, 0.2); */
                                    /* margin: 40px auto 60px auto; */
                                }

                                .post-comments .comments,
                                .post-comments .replies {
                                    list-style-type: none;
                                    margin: 0;
                                    padding: 0;
                                }

                                .post-comments .replies {
                                    margin-left: 40px;
                                }

                                .post-comments .comments li {
                                    clear: both;
                                }

                                .post-comments .comment {
                                    margin: 20px 0;
                                }

                                .post-comments .name {
                                    font-weight: bold;
                                }

                                /* .post-comments .name:after {
                                    content: " says:";
                                } */

                                .post-comments .avatar img {
                                    border-radius: 50%;
                                    float: left;
                                    margin-right: 5px;

                                    width: 30px;
                                    height: 30px;
                                    object-fit: cover;
                                }

                                .post-comments .comment-content {
                                    overflow: hidden;
                                    font-size: var(--rv-0-9);
                                    padding-left: 0.75rem;
                                }

                                .post-comments .comment {
                                    position: relative;
                                    /* min-height: 100px; */
                                }

                                .post-comments .comment:hover .reply {
                                    /* display: block; */

                                    transform: scale(1);
                                    transition: transform 0.2s cubic-bezier(0.5, -0.5, 0.5, 1.5);
                                }

                                .post-comments .comment .reply {
                                    transform-origin: 50% -10px;
                                    transition: transform 0.2s cubic-bezier(0.5, -0.5, 0.5, 1.5);
                                    transform: scale(0);
                                    /* display: none; */

                                    position: absolute;
                                    top: 46px;
                                    left: 16px;
                                    width: 20px;
                                    height: 20px;
                                    border: 2px solid #ccc;
                                    background: #fff;
                                    margin-left: -12px;
                                    z-index: 99;
                                    text-align: center;
                                    line-height: 20px;
                                    font-size: var(--rv-0-8);
                                    color: #ccc;
                                    border-radius: 50%;
                                }

                                .post-comments .reply:before {
                                    content: "";
                                    position: absolute;
                                    top: -12px;
                                    left: 6px;
                                    border-left: 2px solid #ccc;
                                    height: 10px;
                                }

                                .post-comments .reply a {
                                    position: absolute;
                                    top: 0;
                                    right: 0;
                                    bottom: 0;
                                    left: 0;
                                    margin: auto;
                                    text-decoration: none;
                                    color: #ccc;
                                }

                                .post-comments .comment .reply:hover {
                                    transform: scale(1.2);
                                }

                                .post-comments .replies .comment {
                                    position: relative;
                                }

                                .post-comments .replies .comment:before {
                                    content: "";
                                    display: block;
                                    width: 27px;
                                    height: 25px;
                                    height: 15px;
                                    position: absolute;
                                    border: 2px solid #ccc;
                                    border-radius: 0 0 0 25px;
                                    border-top: 0;
                                    border-right: 0;
                                    left: -28px;
                                    bottom: 100%;
                                    margin-bottom: -16px;
                                    z-index: 9;
                                }

                                .post-comments .comment:hover .avatar img {
                                    box-shadow: 0 0 0 5px #fff, 0 0 0 7px #ccc;
                                }

                                .post-comments .replies {
                                    position: relative;
                                }

                                .post-comments .has-replies>.comment {
                                    position: relative;
                                }

                                .post-comments .has-replies>.comment:after {
                                    content: "";
                                    display: block;
                                    position: absolute;
                                    left: 12px;
                                    width: 0;
                                    border-left: 2px solid #ccc;
                                    height: 100%;
                                    top: 30px;
                                    z-index: 1;
                                }

                                .post-comments .replies>li:last-child:before {
                                    content: "";
                                    display: block;
                                    width: 0;
                                    height: 100%;
                                    position: absolute;
                                    border-left: 2px solid #ccc;
                                    border-top: 0;
                                    border-right: 0;
                                    left: -28px;
                                    top: 0;
                                }

                                .post-comments .replies>li:last-child>.comment:after {
                                    content: "";
                                    display: block;
                                    position: absolute;
                                    left: 0;
                                    width: 10px;
                                    height: 100%;
                                    top: 0px;
                                    background: #fff;
                                    /* background: var(--off-white); */
                                    left: -28px;
                                    z-index: 1;
                                }

                                .post-comments .btn {
                                    /* padding: 10px;
                                    border: 1px solid #ccc;
                                    font-weight: bold;
                                    text-transform: uppercase;
                                    color: #ccc;
                                    background: transparent;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    margin-top: 5px; */

                                    margin-top: 5px;
                                }

                                .post-comments .btn:hover {
                                    color: #bbb;
                                }

                                .post-comments .new-comment .reply {
                                    display: none !important;
                                }

                                .post-comments [contentEditable] {
                                    color: #333;
                                    overflow: hidden;
                                    box-shadow: none;
                                    margin-left: 2.75rem;

                                    /* outline: 1px solid #eee; */
                                }

                                .post-comments .name {
                                    color: #333;
                                    overflow: hidden;
                                    box-shadow: none;
                                    margin-left: 2.75rem;

                                    /* outline: 1px solid #eee; */
                                }

                                .post-comments [contentEditable]:focus {
                                    outline-color: transparent;
                                }

                                .post-comments .comment-content[contentEditable] {
                                    /* min-height: 62px; */
                                    outline: 1px solid #eee;
                                    padding: 0.375rem 0.75rem;
                                    height: calc(1.5em + 0.75rem + 2px);
                                    /* margin-left: 0.5rem; */
                                    margin-top: 0.5rem;
                                    border: 1px solid #ced4da;
                                    border-radius: 0.25rem;

                                    /* display: block;
                                    width: 100%;
                                    padding: 0.375rem 0.75rem;
                                    height: calc(1.5em + 0.75rem + 2px);
                                    font-size: var(--rv-1-new);
                                    font-weight: 400;
                                    line-height: 1.5;
                                    color: #495057;
                                    background-color: #fff;
                                    background-clip: padding-box;
                                    border: 1px solid #ced4da;
                                    border-radius: 0.25rem;
                                    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; */

                                }

                                .post-comments .comment-content[contentEditable]:focus {
                                    color: #495057;
                                    background-color: #fff;
                                    border-color: #80bdff;
                                    outline: 0;
                                    box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
                                }

                                .post-comments .reply-done {
                                    margin-left: 34px;
                                    margin-left: 2.75rem;
                                }

                                .post-comments .new-comment {
                                    min-height: 100%;
                                    animation: new 0.4s ease-in-out;
                                }

                                @keyframes new {
                                    0% {
                                        opacity: 0;
                                        height: 0;
                                    }

                                    50% {
                                        opacity: 0;
                                        height: 100px;
                                    }

                                    100% {
                                        opacity: 1;
                                        height: 100px;
                                    }
                                }
                            </style>

                        <?php
                        }


                        ?>


                    </div>

                    <!-- <div class="trending-posts">
                        <div class="section_header mb-1 flex">
                            <div class="title font-1-5 font-semibold flex align-center">
                                <i class='bx bx-trending-up me-0-5'></i> Trending Posts
                            </div>
                        </div>
                    </div> -->

                </div>

                <style>
                    .forum-header {
                        margin: 0 20%;
                    }

                    .forum-flex {
                        display: flex;
                        justify-content: space-between;
                        margin: 0 20%;
                    }

                    .forum-posts {
                        padding-right: 1rem;
                        width: 100%;
                    }

                    .trending-posts {
                        flex-grow: 1;
                        padding: 1rem;
                        background-color: aliceblue;
                        border-radius: 0.5rem;
                        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);

                        position: sticky;
                    }

                    .post-item {
                        display: block;
                        color: inherit;
                        text-decoration: inherit;
                        background-color: white;
                        padding: 1rem;
                        border-radius: 0.5rem;
                        margin-bottom: 1rem;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

                        cursor: pointer;
                    }

                    a.post-item {
                        cursor: pointer;
                    }

                    a.post-item {
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        background-color: var(--off-white);
                    }

                    .user-details {
                        display: flex;
                        align-items: center;
                        margin-bottom: 1rem;
                    }

                    .profile-img img {
                        width: 2.5rem;
                        height: 2.5rem;
                        border-radius: 50%;
                        margin-right: 0.8rem;
                        object-fit: cover;
                    }

                    .user-name {
                        font-size: var(--rv-0-9);
                        font-weight: 600;
                    }

                    .user-name span {
                        font-size: var(--rv-0-75);
                        color: #666;
                        font-weight: 600;
                    }

                    .user-details .spacer {
                        flex-grow: 1;
                    }

                    .date-time {
                        font-size: var(--rv-0-8)
                    }

                    .post-title {
                        font-size: var(--rv-1-3);
                        font-weight: 600;
                        margin-bottom: 0.5rem;
                    }

                    .post-desc {
                        font-size: var(--rv-0-9);
                        margin-bottom: 0.5rem;
                        color: #333;
                    }

                    .post-img img {
                        margin-top: 1rem;
                        width: 100%;
                        border-radius: 0.5rem;
                        margin-bottom: 1rem;
                    }

                    .post-actions {
                        display: flex;
                        justify-content: flex-end;
                    }

                    .action-item {
                        font-size: 1rem;
                        margin-left: 1rem;

                        display: flex;
                        align-items: center;
                    }

                    .action-item i {
                        margin-right: 0.5rem;
                    }

                    .action-item:first-child {
                        margin-left: 0;
                    }

                    .action-item:last-child {
                        margin-right: 0;
                    }
                </style>




            </section>

        </div>

        <!-- <div class="right">
            <div style="width: 30vh;"></div>
        </div> -->

    </div>

    <?php $HTMLFooter = new HTMLFooter(); ?>
    <script>
        let BASE_URL = "<?= BASE_URL ?>";
        let profile_img = "<?= USER_IMG_PATH . $_SESSION['user_img'] ?>";
        let user_name = "<?= $_SESSION['user_name'] ?>";
    </script>
    <script>
        var avatar = '<aside class="avatar">' +
            '<img src="{{profile_img}}" alt="">' +
            '<div class="name">{{user_name}}</div>' +
            '</aside>';
        avatar = avatar.replace("{{profile_img}}", profile_img);
        avatar = avatar.replace("{{user_name}}", user_name);
        var comment = '<div class="comment-content" contentEditable="true">Enter Your Comment</div><div class="reply"><a href="#reply" title="Reply to this comment">+</a></div>';
        var done = "<button class='reply-done btn btn-primary'>Done</button>";

        $('.comments').on('click', '.reply', newCommentBlock).on('click', '.reply-done', submitHandler);
        var newComment = "<li><article class='comment new-comment'>" + avatar + comment + done + "</div></li>";


        function newCommentBlock(e) {

            // if there are other new comment blocks remove them
            // get parent .replies
            // if($('.new-comment').length > 0) {
            //     // get the parent .replies
            //     var $replies = $(this).closest('.replies').remove();
            // }

            // $('article.new-comment').parent().parent().remove();


            // console.log('new comment block');
            submitHandler(null);
            var $replybtn = $(this);
            var $comment = $(this).parent();
            var $replies = $comment.next('.replies');

            var newComment = "<li><article class='comment new-comment'>" + avatar + comment + done + "</div></li>";

            if ($replies.length > 0) {
                console.log('has replies');
            } else {
                $comment.after('<ol class="replies"></ol>');
                $comment.parent().addClass('has-replies');
                $replies = $comment.next('.replies');
            }

            $replies.prepend(newComment);
        }

        function submitHandler(e) {

            // get content
            let content = $('.new-comment .comment-content').text().trim();
            if (content != "") {
                // console.log(content);

                let $this = $('.new-comment .comment-content');
                let post_id = $this.closest('.post-item').attr('data-id');
                let parent_id = $this.closest('.has-replies').children('.comment').attr('data-id');

                // console.log(post_id, parent_id);
                // return;

                if (parent_id == undefined || parent_id == null)
                    return;

                $.ajax({
                    url: `${BASE_URL}/forum/add_comment/${post_id}`,
                    type: 'post',
                    data: {
                        content: content,
                        parent_id: parent_id
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
            }

            $('.new-comment').removeClass('new-comment');
            $('[contentEditable]').each(function() {
                $(this).text($(this).text().trim());
            })
            $('[contentEditable]').removeAttr('contentEditable');
            $('.reply-done').remove();
        }


        $(document).ready(function() {

            let new_comment_template = `<li> <article class="comment">
                                                <aside class="avatar">
                                                    <img src="{{profile_img}}" alt="">
                                                    <div class="name">{{user_name}}</div>
                                                </aside>
                                                <div class="comment-content">{{comment</div>
                                                <div class="reply"><a href="#reply" title="Reply to this comment">+</a></div>
                                            </article>
                                        </li>`;

            $(document).on("click", ".new-comment-btn", function(event) {
                let $this = $(this);
                event.preventDefault();
                // get post id
                let post_id = $this.closest(".post-item").attr("data-id");
                let comment = $this.closest(".post-item").find("#new_comment").val();

                let parent_id = 0;

                // if has class reply-done
                // if ($(this).hasClass("reply-done")) {
                //     parent_id = $(this).closest(".comment").attr("data-id");
                //     comment = $(this).closest(".comment").find(".comment-content").text();
                //     console.log(parent_id, comment, post_id);
                // }
                // let $this = $(this);

                $.ajax({
                    url: `${BASE_URL}/forum/add_comment/${post_id}`,
                    type: 'post',
                    data: {
                        content: comment,
                        parent_id: 0
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", response['desc'])

                            // append new comment
                            let new_comment = new_comment_template.replace("{{profile_img}}", profile_img);
                            new_comment = new_comment.replace("{{user_name}}", user_name);
                            new_comment = new_comment.replace("{{comment", comment);

                            $this.closest(".post-item").find(".comments").append(new_comment);
                            $this.closest(".post-item").find("#new_comment").val("");
                            console.log(new_comment);


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

            $(document).on("click", ".delete-item", function() {
                let id = $(this).attr("data-id");
                let $this = $(this);

                // confirm delete
                if (!confirm("Are you sure you want to delete this item?"))
                    return;

                $.ajax({
                    url: `${BASE_URL}/elections/delete/${id}`,
                    type: 'post',
                    data: {
                        delete: true
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", response['desc'])
                            $this.closest(".todo_item").remove();
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

            $(document).on("click", ".teachingRequestButton", function() {
                $.ajax({
                    url: `${BASE_URL}/Courses/clickToBeRole/teaching_student`,
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

        });
    </script>
    <script>

    </script>