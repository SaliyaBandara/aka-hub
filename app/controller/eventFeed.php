<?php
class eventFeed extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/eventFeed");
        die();
    }

    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Event Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["posts"] = $this->model('readModel')->getAllCounselorPosts(2);

        $data["clubs"] = $this->model('readModel')->getAllClubs();

        $data["buttonValue"] = "My Uploads";
        $data["link"] = "viewOwnPosts";
        $data["iClass"] = "bx-image-add";
        $data["topic"] = "Club Event Feed";
        $data["filter"] = 1;

        $data["comments"] = [];
        $data["clubReps"] = [];
        $data["liked"] = [];

        foreach ($data["posts"] as $post) {

            $commentsForPost = $this->model('readModel')->getPostComments($post['id']);
            $club = $this->model('readModel')->getClubRep($post['posted_by']);
            $liked = $this->model('readModel')->getPostLikes($post['id'], $_SESSION['user_id']);

            if (!empty($commentsForPost)) {
                // print_r($commentsForPost);
                $data['comments'] = array_merge($data['comments'], $commentsForPost);
            }

            if (!empty($club)) {
                // print_r($commentsForPost);
                $data['clubReps'] = array_merge($data['clubReps'], $club);
            }

            if (!empty($liked)) {
                $data['liked'] = array_merge($data['liked'], $liked);
            }
        }

        $this->view->render('clubRep/eventFeed/index', $data);
    }

    public function filter()
    {

        $this->requireLogin();
        $data = [
            'title' => 'Event Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        $club_id = $_POST['club_id'];

        if ($club_id == 0) {
            $data["posts"] = $this->model('readModel')->getAllCounselorPosts(2);
        } else {
            $data["posts"] = $this->model('readModel')->getPostsOfClubs($club_id);
        }

        $data["clubs"] = $this->model('readModel')->getAllClubs();

        $data["comments"] = [];
        $data["clubReps"] = [];
        $data["liked"] = [];


        if (!empty($data["posts"])) {
            foreach ($data["posts"] as $post) {

                $commentsForPost = $this->model('readModel')->getPostComments($post['id']);
                $club = $this->model('readModel')->getClubRep($post['posted_by']);
                $liked = $this->model('readModel')->getPostLikes($post['id'], $_SESSION['user_id']);

                if (!empty($commentsForPost)) {
                    // print_r($commentsForPost);
                    $data['comments'] = array_merge($data['comments'], $commentsForPost);
                }

                if (!empty($club)) {
                    // print_r($commentsForPost);
                    $data['clubReps'] = array_merge($data['clubReps'], $club);
                }

                if (!empty($liked)) {
                    $data['liked'] = array_merge($data['liked'], $liked);
                }
            }
        }

        $BASE_URL =  BASE_URL;

        if (empty($data["posts"])) {
            echo "<div class='font-meidum text-muted'> No Posts Found! </div>";
        } else {
            foreach ($data["posts"] as $posts) {
                echo '
                <div class="feedPost my-2">
                    <div class="postDetails">
                        <div class="detailsLeft">
                            <div class="userImage">
                                <img src=' . USER_IMG_PATH . $posts["profile_img"] . ' alt="">
                            </div>
                            <div class="userDetails">
                                <div class="userName">
                                    ' . $posts["name"] . '
                                </div>
                                <div class="publishedDate">
                                    ' . date('d/m/y H:i', strtotime($posts["created_datetime"])) . '
                                </div>
                            </div>
                        </div>
                        <div class="detailsRight">
                            ';
                if (($_SESSION["club_rep"] && ($posts['posted_by'] == $_SESSION["user_id"])) || $_SESSION["user_role"] == 1) {
                    echo '
                                <div class="editDeleteButton">
                                    <a href= ' . $BASE_URL . '/eventFeed/add_edit/' . $posts['id'] . ' class="repDecline">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <a class="repDecline delete-item" data-id="' . $posts['id'] . '">
                                        <i class="bx bx-trash text-danger"></i>
                                    </a>
                                </div>';
                }

                echo '
                        </div>
                    </div>
                    <div class="postTitle my-1 font-bold">' . strtoupper($posts["title"]) . '</div> 
                    <img class="postImage" src= ' . USER_IMG_PATH . $posts["post_image"] . ' alt="">
                    <div class="postTitle font-bold mt-1 mx-1" style="text-align:right !important;">
                        ' . $club = " ";

                foreach ($data["clubReps"] as $clubRep) {
                    if ($clubRep["user_id"] == $posts["posted_by"]) {
                        $club = $clubRep["name"];
                    }
                }
                echo '
                        <em>Posted by : ' . $club . '</em>
                    </div>
                    <div style="white-space: pre-line; text-align:left;" class="mx-1">
                        ' . substr($posts["description"], 0, 500) . (strlen($posts["description"]) > 500 ? '...' : '') . '
                    </div>
                    
                    <div class="postDetails">
                        <div class="detailsLeft">
                            <div class="likeCommentButton">
                                ';
                $likedToPost = false;

                foreach ($data['liked'] as $liked) {
                    if ($liked['post_id'] == $posts['id']) {
                        $likedToPost = true;
                        break;
                    }
                }

                $heartIconClass = $likedToPost ? "bx bxs-heart text-danger likeButton" : "bx bx-heart likeButton text-danger likeButton";

                echo '
                                <a class="likePost" data-id="' . $posts["id"] . '">
                                    <i class="' . $heartIconClass . '"></i>
                                </a>
                                <label class="likeCountLabel">
                                    ' . ($posts['likesCount'] === null ? '0 Likes' : $posts['likesCount'] . ' Likes') . '
                                </label>
                                <a href="#" id="commentsToggle">
                                    <i class="bx bx-message-rounded"></i>
                                </a>
                                ';

                $postIdToFind = $posts['id'];
                $hasComments = false;
                $count = 0;

                foreach ($data['comments'] as $comment) {
                    if ($comment['post_id'] == $postIdToFind) {
                        $count++;
                    }
                }

                echo '
                                <label id="commentCount">
                                    ' . $count . ' Comments
                                </label> 
                            </div>
                        </div>
                    </div>
                    <div id="commentsSection" style="display: none;" class="my-2">
                        <div class="font-medium font-1 text-left mx-1"> Comments </div>';

                $postIdToFind = $posts['id'];
                $hasComments = false;

                foreach ($data['comments'] as $comment) {
                    if ($comment['post_id'] == $postIdToFind) {
                        $img_src_comment = USER_IMG_PATH . $comment["profile_img"];

                        echo '
                                <div class="commentContent flex flex-row">
                                    <div class="userImageComment">
                                        <img src="' . $img_src_comment . '" alt="">
                                    </div>
                                    <div class="flex flex-column justify-center">
                                        <div class="text-medium mx-0-5 flex" style="font-size: 9px;"> ' . $comment['name'] . '</div>
                                        <div class="text-medium font-1 mx-0-5 flex"> ' . $comment['comment'] . ' </div>
                                    </div>';

                        if ($comment["user_id"] == $_SESSION["user_id"] || $comment["posted_by"] == $_SESSION["user_id"] || $_SESSION["user_role"] == 1) {
                            echo '<div class="text-medium mx-0-5 text-danger flex justify-center align-center deleteComment" style="font-size: 18px; cursor: pointer;" data-id="' . $comment['id'] . '"> <i class="bx bx-trash"></i> </div>';
                        }

                        echo '</div>';

                        $hasComments = true;
                    }
                }

                if (!$hasComments) {
                    echo '<div class="text-muted font-medium mx-1 my-1 font-1" style="text-align: left;">No comments to show</div>';
                }

                echo '
                    </div>
                    <hr></hr>
                    <div class="addCommentSection my-1 form-group">
                        <div>
                            <form action="" method="post" class="form">
                                <div class="flex flex-row">
                                    <div class="mb-1 ms-1 form-group">
                                        <label for="name" class="form-label" style="text-align: left !important;">
                                            Add new comment
                                        </label>
                                        <input type="text" id="newComment" name="newComment" class="form-control textBox" placeholder="Enter comment" value="" data-validation="required">
                                    </div>
                                    <div href="#" class="my-0-5">
                                        <div class="btn btn-primary mb-1 mx-1 my-1 addCommentButton" id="' . $posts["id"] . '">
                                            Post
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>';
            }
        }
    }

    public function viewOwnPosts()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Event Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        // $post_id = 5;
        if (($_SESSION["club_rep"])) {
            $data["posts"] = $this->model('readModel')->getCounselorPosts(2, $_SESSION["user_id"]);
        }

        $data["clubs"] = $this->model('readModel')->getAllClubs();
        // $data["comments"] = $this->model('readModel')->getPostComments($post_id);
        // print_r($data["clubs"]);

        $data["buttonValue"] = "All Uploads";
        $data["link"] = "index";
        $data["iClass"] = "bx-image";
        $data["topic"] = "My Uploads";
        $data["filter"] = 0;

        $data["comments"] = [];
        $data["clubReps"] = [];
        $data["liked"] = [];

        if(!empty($data["posts"])){
            foreach ($data["posts"] as $post) {

                $commentsForPost = $this->model('readModel')->getPostComments($post['id']);
                $club = $this->model('readModel')->getClubRep($post['posted_by']);
                $liked = $this->model('readModel')->getPostLikes($post['id'], $_SESSION['user_id']);

                if (!empty($commentsForPost)) {
                    // print_r($commentsForPost);
                    $data['comments'] = array_merge($data['comments'], $commentsForPost);
                }

                if (!empty($club)) {
                    // print_r($club);
                    $data['clubReps'] = array_merge($data['clubReps'], $club);
                }

                if (!empty($liked)) {
                    $data['liked'] = array_merge($data['liked'], $liked);
                }
            }
        }

        $this->view->render('clubRep/eventFeed/index', $data);
    }

    public function add_edit($id = 0)
    {
        $this->requireLogin();
        if ((!($_SESSION["club_rep"] || $_SESSION["user_role"] == 1))) {
            $action = "Unauthorized User tried to edit add event feed without permission";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => ($id == 0) ? 'Create Post' : 'Edit Post',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["post_template"] = $this->model('readModel')->getEmptyCounselorPost();
        $data["post"] = $data["post_template"]["empty"];
        $data["post_template"] = $data["post_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];

            $values["posted_by"] = $_SESSION["user_id"];
            $values["post_image"] = $values["post_image"];
            $values["type"] = '2';
            $values["updated_datetime"] = date('Y-m-d H:i:s');
            
            $values["updated_datetime"] = date('Y-m-d H:i:s', strtotime($values["updated_datetime"]));

            // print_r($values["updated_datetime"]);
            // die();

            $this->validate_template($values, $data["post_template"]);

            if ($id == 0) {
                $task = "User created a new post in event feed";
                $state = "201";
                $this->model("createModel")->createLogEntry($task, $state);

                $result = $this->model('createModel')->insert_db("posts", $values, $data["post_template"]);
            } else {
                $task = "User updated a post in event feed";
                $state = "200";
                $this->model("createModel")->createLogEntry($task, $state);

                $result = $this->model('updateModel')->update_one("posts", $values, $data["post_template"], "id", $id, "i");
            }
            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Something went wrong")));
        }

        $data["id"] = $id;
        // $data["action"] = $action;

        if ($id != 0) {
            $data["post"] = $this->model('readModel')->getOne("posts", $id);
            if (!$data["post"])
                $this->redirect();
        }

        $this->view->render('clubRep/eventFeed/add_edit', $data);


        // getEmptyCounselorPost
    }

    public function delete($id = 0)
    {

        $this->requireLogin();
        if ((!($_SESSION["club_rep"] || $_SESSION["user_role"] == 1))) {
            $action = "Unauthorized User tried to delete event feed without permission";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Invalid post id")));

        // $result = $this->model('deleteModel')->deleteOne("courses", $id);
        $result = $this->model('deleteModel')->deleteOne("posts", $id);

        if ($result) {
            $task = "User deleted a post in event feed";
            $state = "200";
            $this->model("createModel")->createLogEntry($task, $state);
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));
        }
        die(json_encode(array("status" => "400", "desc" => "Error while deleting post")));
    }

    public function like($id = 0)
    {

        $this->requireLogin();

        $data["likes_template"] = $this->model('readModel')->getEmptyPostLikes();
        $data["likes"] = $data["likes_template"]["empty"];
        $data["likes_template"] = $data["likes_template"]["template"];

        $values["user_id"] = $_SESSION["user_id"];
        $values["post_id"] = $id;

        $existingLike = $this->model('readModel')->getPostLikes($id, $_SESSION["user_id"]);
        print_r($existingLike);

        if ($existingLike) {
            $task = "User tried to like a post that has already been liked";
            $state = "401";
            $this->model("createModel")->createLogEntry($task, $state);
            die(json_encode(array("status" => "400", "desc" => "You have already liked this post")));
        }

        $this->validate_template($values, $data["likes_template"]);

        $result = $this->model('createModel')->insert_db("post_likes", $values, $data["likes_template"]);

        if ($result) {

            $task = "User liked a post in event feed";
            $state = "200";
            $this->model("createModel")->createLogEntry($task, $state);
            die(json_encode(array("status" => "200", "desc" => "Liked")));
        }

        die(json_encode(array("status" => "400", "desc" => "Something went wrong")));
    }

    public function clickToBeClubRep($club_id)
    {
        $this->requireLogin();

        if ($_SESSION["user_role"] != 0) {
            $action = "Unauthorized User tried to be a club rep without permission";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }

        $data["clubRep_template"] = $this->model('readModel')->getEmptyClubReps();
        $data["clubRep"] = $data["clubRep_template"]["empty"];
        $data["clubRep_template"] = $data["clubRep_template"]["template"];

        $data["alreadyRequested"] = $this->model('readModel')->getClubRepByUser($_SESSION["user_id"],0);
        $data["alreadyGiven"] = $this->model('readModel')->getClubRepByUser($_SESSION["user_id"],1);

        if ($_SESSION["club_rep"] == 1 || (!empty($data["alreadyGiven"]))) {

            die(json_encode(array("status" => "400", "desc" => "You are already a Club Representative")));

        } else if ($_SESSION["club_rep"] == 2 || (!empty($data["alreadyRequested"]))) {

            die(json_encode(array("status" => "400", "desc" => "Already requested")));

        } else if ($_SESSION["club_rep"] == 0 || (empty($data["alreadyGiven"]))) {

            $resultUpdate = $this->model('updateModel')->to_get_role(
                "user",
                "club_rep",
                $_SESSION["user_id"],
                2
            );

            $values['club_id'] = $club_id;
            $values['user_id'] = $_SESSION["user_id"];
            $values['status'] = 0;

            $resultCreate = $this->model('createModel')->insert_db("club_representative", $values, $data["clubRep_template"]);

            if ($resultUpdate && $resultCreate) {
                $task = "User requested to be a club rep";
                $state = "200";
                $this->model("createModel")->createLogEntry($task, $state);
                die(json_encode(array("status" => "200", "desc" => "Successfully requested")));
            } else {
                die(json_encode(array("status" => "400", "desc" => "Request unsuccessfull")));
            }
        }
    }

    public function postComment($post_id)
    {
        $this->requireLogin();

        $comment = $_POST["comment"];

        $data["comment_template"] = $this->model('readModel')->getEmptyPostComments();
        $data["commentContent"] = $data["comment_template"]["empty"];
        $data["comment_template"] = $data["comment_template"]["template"];

        // $comment = str_replace('%20', ' ', $comment);

        $values['post_id'] = $post_id;
        $values['user_id'] = $_SESSION["user_id"];
        $values['comment'] = $comment;

        // print_r($comment);
        // die();

        $result = $this->model('createModel')->insert_db("post_comments", $values, $data["comment_template"]);

        if ($result) {
            $task = "User posted a comment in event feed";
            $state = "201";
            $this->model("createModel")->createLogEntry($task, $state);
            die(json_encode(array("status" => "200", "desc" => "Comment Posted")));
        } else {
            die(json_encode(array("status" => "400", "desc" => "Failed to post the comment")));
        }
    }

    public function deleteComment($id = 0)
    {

        $this->requireLogin();
        // if ($_SESSION["user_role"] != 1)
        //     $this->redirect();

        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Invalid comment id")));

        // $result = $this->model('deleteModel')->deleteOne("courses", $id);
        $result = $this->model('deleteModel')->deleteOne("post_comments", $id);

        if ($result) {
            $task = "User deleted a comment in event feed";
            $state = "200";
            $this->model("createModel")->createLogEntry($task, $state);
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));
        }
        die(json_encode(array("status" => "400", "desc" => "Error while deleting the comment")));
    }

    public function getComments()
    {
        $postId = $_POST['postId'];
        $comments = $this->model('readModel')->getPostComments($postId);

        $data['comments'] = $comments;

        echo '
            <div class="font-medium font-1 text-left mx-1"> Comments </div>';

        $hasComments = false;

        foreach ($data['comments'] as $comment) {
            echo '
                        <div class="commentContent flex flex-row">
                            <div class="userImageComment">
                                <img src="' . USER_IMG_PATH . $comment["profile_img"] . '" alt="">
                            </div>
                            <div class="flex flex-column justify-center">
                                <div class="text-medium mx-0-5 flex" style="font-size: 9px;">' . $comment['name'] . '</div>
                                <div class="text-medium font-1 mx-0-5 flex">' . $comment['comment'] . '</div>
                            </div>';

            if ($comment["user_id"] == $_SESSION["user_id"] || $comment["posted_by"] == $_SESSION["user_id"] || $_SESSION["user_role"] == 1) {
                echo '<div class="text-medium mx-0-5 text-danger flex justify-center align-center deleteComment" style="font-size: 18px; cursor: pointer;" data-id="' . $comment['id'] . '"> <i class="bx bx-trash"></i> </div>';
            }

            echo '</div>';

            $hasComments = true; // Set flag to true as comments exist
        }

        // If no comments were found, display a message
        if (!$hasComments) {
            echo '<div class="text-muted font-medium mx-1 my-1 font-1" style="text-align: left;">No comments to show</div>';
        }

        echo '</div>';
    }
}
