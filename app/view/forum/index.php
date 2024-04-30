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
                        <div class="title font-1-5 font-semibold flex align-center">
                            <i class='bx bx-conversation ms-0-5 me-0-5'></i> Public Student Forum
                        </div>
                        <a href="<?= BASE_URL ?>/forum/add_edit/0/create" class="btn btn-primary">
                            <i class='bx bx-plus'></i> Create New Post
                        </a>
                    </div>
                </div>

                <div class="forum-flex">

                    <div class="forum-posts">

                        <!-- <div class="post-item">
                            <div class="user-details">
                                <div class="profile-img">
                                    <img src="<?= USER_IMG_PATH ?>election_question_20240426073902662b0cbe4ba8303098940017140973421107.jpg" alt="profile">
                                </div>
                                <div class="user-name font-semibold">
                                    Saliya Bandara<br />
                                    <span class="font-0-8">2nd Year Student</span>
                                </div>
                                <div class="spacer"></div>
                                <div class="date-time">27th April 2024</div>
                            </div>
                            <div class="post-content">
                                <div class="post-title">How to properly implement a websocket solution with SSE using
                                    PHP?</div>
                                <div class="post-desc">I am trying to implement a websocket solution with SSE using PHP.
                                    I have tried a few solutions but none of them are working properly. THe image below
                                    shows the final look of the solution I am trying to implement. Can someone help me
                                    with this?</div>
                                <div class="post-img">
                                    <img src="<?= USER_IMG_PATH ?>election_question_20240418202321662133e1d374008661150017134520019980.jpg" alt="post image">
                                </div>
                                <div class="post-actions">
                                    <div class="action-item">
                                        <i class='bx bx-comment'></i> 5
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <?php

                        // print_r($data['items']);
                        // die;

                        foreach ($data['items'] as $key => $value) {
                            $img = USER_IMG_PATH . $value['image'];
                            $value['created_at'] = date("d M Y", strtotime($value['created_at']));

                            $user_img = USER_IMG_PATH . $value['user']['profile_img'];

                            // get user year with suffix
                            $suffixes = ["st", "nd", "rd", "th"];

                            $year = $value['user']['year'] . "th Year Student";
                            if ($value['user']['year'] < 4)
                                $year = $value['user']['year'] . $suffixes[$value['user']['year'] - 1] . " Year Student";

                        ?>

                            <a class="post-item" href="<?= BASE_URL ?>/forum/post/<?= $value['id'] ?>">
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
                            </a>

                        <?php
                        }


                        ?>


                    </div>

                    <div class="trending-posts">
                        <div class="section_header mb-1 flex">
                            <div class="title font-1-5 font-semibold flex align-center">
                                <i class='bx bx-trending-up me-0-5'></i> Trending Posts
                            </div>
                        </div>
                    </div>

                </div>

                <style>
                    .forum-header {
                        margin: 0 10%;
                    }

                    .forum-flex {
                        display: flex;
                        justify-content: space-between;
                        margin: 0 10%;
                    }

                    .forum-posts {
                        padding-right: 1rem;
                        width: 70%;
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

                        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
                        cursor: pointer;

                    }

                    .post-item:hover {
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
    </script>
    <script>
        $(document).ready(function() {

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