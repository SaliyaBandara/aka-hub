<?php
class Forum extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/forum");
        die();
    }

    public function checkAdmin()
    {
        if ($_SESSION["student_rep"] != 1 && $_SESSION["club_rep"] != 1 &&  $_SESSION["user_role"] != 1)
            $this->redirect();
    }

    public function checkAccess($election)
    {
        // if student rep type should be 1
        // if club rep type should be 0
        if ($_SESSION["student_rep"] == 1)
            return true;

        if ($_SESSION["club_rep"] == 1 && $election["type"] == 0)
            return true;

        if ($_SESSION["user_role"] == 1)
            return true;

        return false;
    }
    public function index()
    {
        $this->requireLogin();

        $data = [
            'title' => 'Elections',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["student_rep"] = $_SESSION["student_rep"];
        $data["club_rep"] = $_SESSION["club_rep"];

        $data["edit_access"] = false;
        if ($_SESSION["student_rep"] == 1 || $_SESSION["club_rep"] == 1 || $_SESSION["user_role"] == 1)
            $data["edit_access"] = true;

        $data["items"] = $this->model('readModel')->getForumPosts();
        $this->view->render('forum/index', $data);
    }




    //     -- forum post
    // CREATE TABLE forum_posts (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     user_id INT NOT NULL,
    //     title VARCHAR(255) NOT NULL,
    //     content TEXT NOT NULL,
    //     image VARCHAR(255) DEFAULT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (user_id) REFERENCES user(id)
    // );

    // -- forum comments
    // -- thread style
    // CREATE TABLE forum_comments (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     user_id INT NOT NULL,
    //     post_id INT NOT NULL,
    //     parent_id INT DEFAULT NULL,
    //     content TEXT NOT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (user_id) REFERENCES user(id),
    //     FOREIGN KEY (post_id) REFERENCES forum_posts(id),
    //     FOREIGN KEY (parent_id) REFERENCES forum_comments(id)
    // );


    public function add_edit($id = 0, $action = "create")
    {
        $this->requireLogin();
        if ($id != 0) {
            $post = $this->model('readModel')->getOne("forum_posts", $id);
            // check if valid post and user is the owner
            if (!$post || $post["user_id"] != $_SESSION["user_id"])
                $this->redirect();
        }

        $data = [
            'title' => ($action == "create") ? 'Create Forum Post' : 'Edit Forum Post',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["item_template"] = $this->model('readModel')->getEmptyForumPost();
        $data["item"] = $data["item_template"]["empty"];
        $data["item_template"] = $data["item_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];
            $values["user_id"] = $_SESSION["user_id"];
            $this->validate_template($values, $data["item_template"]);

            if ($id == 0)
                $result = $this->model('createModel')->insert_db("forum_posts", $values, $data["item_template"]);
            else
                $result = $this->model('updateModel')->update_one("forum_posts", $values, $data["item_template"], "id", $id, "i");

            if ($result) {
                if ($id == 0) {
                    $id = $result;
                    die(json_encode(array("status" => "200", "desc" => "Post Added to the Forum Successfully", "redirect" => "/forum/view/$id")));
                }
                die(json_encode(array("status" => "200", "desc" => "Post Updated Successfully", "redirect" => "/forum/view/$id")));
            }

            die(json_encode(array("status" => "400", "desc" => "Error while " . $action . "ing election")));
        }

        $data["id"] = $id;
        $data["action"] = $action;

        if ($id != 0) {
            $data["item"] = $this->model('readModel')->getOne("forum_posts", $id);
            if (!$data["item"])
                $this->redirect();
        }

        // print params
        // print_r($id);
        // print_r($action);

        $this->view->render('forum/add_edit', $data);
    }

    public function post($id = 0)
    {
        $this->requireLogin();
        $data = [
            'title' => 'Forum Post',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["item"] = $this->model('readModel')->getForumPost($id);
        if (!$data["item"])
            $this->redirect();

        $data["item"] = [$data["item"]];
        // print_r($data["item"]);
        // die;

        $this->view->render('forum/view', $data);
    }

    public function add_comment($id = 0)
    {
        $this->requireLogin();
        $data = [
            'title' => 'Add Comment',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["item"] = $this->model('readModel')->getForumPost($id);
        if (!$data["item"])
            $this->redirect();

        $data["comment_template"] = $this->model('readModel')->getEmptyForumComment();
        $data["comment_template"] = $data["comment_template"]["template"];


        if (isset($_POST['content'])) {
            $values = $_POST;
            $values["user_id"] = $_SESSION["user_id"];
            $values["post_id"] = $id;
            $values["parent_id"] = $values["parent_id"] ?? null;
            $values["content"] = $values["content"] ?? "";

            if($values["parent_id"] == 0)
                $values["parent_id"] = null;

            
            $this->validate_template($values, $data["comment_template"]);
            $result = $this->model('createModel')->insert_db("forum_comments", $values, $data["comment_template"]);
            if ($result) 
                die(json_encode(array("status" => "200", "desc" => "Comment Added to the Post Successfully")));
            
            die(json_encode(array("status" => "400", "desc" => "Error while adding comment")));
        }
        
        die(json_encode(array("status" => "400", "desc" => "Error while adding comment")));
    }
}
