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

        $data["comments"] = [];
        $data["clubReps"] = [];

        foreach ($data["posts"] as $post) {

            $commentsForPost = $this->model('readModel')->getPostComments($post['id']);
            $club = $this->model('readModel')->getClubRep($post['posted_by']);

            if(!empty($commentsForPost)){
                // print_r($commentsForPost);
                $data['comments'] = array_merge($data['comments'], $commentsForPost);
            }

            if(!empty($club)){
                // print_r($commentsForPost);
                $data['clubReps'] = array_merge($data['clubReps'], $club);
            }
        }

        // print_r($data['comments']);
        // print_r($data['clubReps']);

        $this->view->render('clubRep/eventFeed/index', $data);
    }

    public function viewOwnPosts()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Event Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        // $post_id = 5;
        if(($_SESSION["club_rep"])){
            $data["posts"] = $this->model('readModel')->getCounselorPosts(2,$_SESSION["user_id"]);
        }
        
        $data["clubs"] = $this->model('readModel')->getAllClubs();
        // $data["comments"] = $this->model('readModel')->getPostComments($post_id);
        // print_r($data["clubs"]);

        $data["buttonValue"] = "All Uploads";
        $data["link"] = "index";
        $data["iClass"] = "bx-image";
        $data["topic"] = "My Uploads";

        $data["comments"] = [];
        $data["clubReps"] = [];

        foreach ($data["posts"] as $post) {

            $commentsForPost = $this->model('readModel')->getPostComments($post['id']);
            $club = $this->model('readModel')->getClubRep($post['posted_by']);

            if(!empty($commentsForPost)){
                // print_r($commentsForPost);
                $data['comments'] = array_merge($data['comments'], $commentsForPost);
            }

            if(!empty($club)){
                // print_r($commentsForPost);
                $data['clubReps'] = array_merge($data['clubReps'], $club);
            }
        }

        $this->view->render('clubRep/eventFeed/index', $data);
    }

    public function add_edit($id = 0)
    {
        $this->requireLogin();
        if (!($_SESSION["club_rep"]))
            $this->redirect();

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

            $this->validate_template($values, $data["post_template"]);

            if ($id == 0)
                $result = $this->model('createModel')->insert_db("posts", $values, $data["post_template"]);
            else
                $result = $this->model('updateModel')->update_one("posts", $values, $data["post_template"], "id", $id, "i");

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
        if (!($_SESSION["club_rep"]))
            $this->redirect();

        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Invalid post id")));

        // $result = $this->model('deleteModel')->deleteOne("courses", $id);
        $result = $this->model('deleteModel')->deleteOne("posts", $id);

        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));

        die(json_encode(array("status" => "400", "desc" => "Error while deleting post")));
    }

    public function like($id = 0)
    {

        $this->requireLogin();
        // if ($_SESSION["user_role"] != 5)
        //     $this->redirect();
        $data["likes_template"] = $this->model('readModel')->getEmptyPostLikes();
        $data["likes"] = $data["likes_template"]["empty"];
        $data["likes_template"] = $data["likes_template"]["template"];
        // print_r($data["likes_template"]);
        // if ( isset($_POST['like'])) {

            // $values = $_POST["like"];
            // print_r($values);
        
        $values["user_id"] = $_SESSION["user_id"];
        $values["post_id"] = $id;

        $existingLike = $this->model('readModel')->getPostLikes($id,$_SESSION["user_id"]);
        print_r($existingLike);

        if ($existingLike) {
            die(json_encode(array("status" => "400", "desc" => "You have already liked this post")));
        }

        $this->validate_template($values, $data["likes_template"]);

        $result = $this->model('createModel')->insert_db("post_likes", $values, $data["likes_template"]);

        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Liked")));

        die(json_encode(array("status" => "400", "desc" => "Something went wrong")));
        // }

    }

    public function clickToBeClubRep($club_id)
    {
        $this->requireLogin();

        $data["clubRep_template"] = $this->model('readModel')->getEmptyClubReps();
        $data["clubRep"] = $data["clubRep_template"]["empty"];
        $data["clubRep_template"] = $data["clubRep_template"]["template"];

        // print_r($_SESSION["club_rep"] );

        if ($_SESSION["club_rep"] == 1) {
            die(json_encode(array("status" => "400", "desc" => "You are already a Club Representative")));
        } else if ($_SESSION["club_rep"] == 2) {
            die(json_encode(array("status" => "400", "desc" => "Already requested")));
        } else if ($_SESSION["club_rep"] == 0) {

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

            if ($resultUpdate && $resultCreate )
                die(json_encode(array("status" => "200", "desc" => "Successfully requested")));
            else {
                die(json_encode(array("status" => "400", "desc" => "Requested unsuccessfull")));
            }
        }
    }

    public function postComment($post_id,$comment)
    {
        $this->requireLogin();

        $data["comment_template"] = $this->model('readModel')->getEmptyPostComments();
        $data["commentContent"] = $data["comment_template"]["empty"];
        $data["comment_template"] = $data["comment_template"]["template"];

        $comment = str_replace('%20', ' ', $comment);

        $values['post_id'] = $post_id;
        $values['user_id'] = $_SESSION["user_id"];
        $values['comment'] = $comment;

        // print_r($comment);

        $result = $this->model('createModel')->insert_db("post_comments", $values, $data["comment_template"]);

        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Comment Posted")));
        else {
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

        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));

        die(json_encode(array("status" => "400", "desc" => "Error while deleting the comment")));
    }
}