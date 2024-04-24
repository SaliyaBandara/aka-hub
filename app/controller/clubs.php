<?php
class Clubs extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/approveRepresentatives");
        die();
    }

    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1){
            $action = "User tried to add clubs without permission";
            $status = "400";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'Clubs and Societies',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["clubs"] = $this->model('readModel')->getAllClubs();

        $this->view->render('admin/clubs/index', $data);
    }

    public function add_edit($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1){
            $action = "User tried to add clubs without permission";
            $status = "400";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => ($id == 0) ? 'Create Club' : 'Edit Club',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["club_template"] = $this->model('readModel')->getEmptyClub();
        $data["club"] = $data["club_template"]["empty"];
        $data["club_template"] = $data["club_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];

            $this->validate_template($values, $data["club_template"]);

            if ($id == 0){
                $action  = "Club created by admin";
                $status = "201";
                $this->model("createModel")->createLogEntry($action, $status);
                $result = $this->model('createModel')->insert_db("clubs", $values, $data["club_template"]);
             } else{
                $action  = "Club updated by admin";
                $status = "200";
                $this->model("createModel")->createLogEntry($action, $status);
                $result = $this->model('updateModel')->update_one("clubs", $values, $data["club_template"], "id", $id, "i");
             }
            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Something went wrong")));
        }

        $data["id"] = $id;
        // $data["action"] = $action;

        if ($id != 0) {
            $data["club"] = $this->model('readModel')->getOne("clubs", $id);
            if (!$data["club"])
                $this->redirect();
        }

        $this->view->render('admin/clubs/add_edit', $data);


        // getEmptyCounselorPost
    }

    public function delete($id = 0)
    {

        $this->requireLogin();
        if ($_SESSION["user_role"] != 1){
            $action = "User tried to delete clubs without permission";
            $status = "400";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        if ($id == 0){
            $action = "User tried to delete clubs without permission";
            $status = "400";
            $this->model("createModel")->createLogEntry($action, $status);
            die(json_encode(array("status" => "400", "desc" => "Invalid club id")));
        }
        // $result = $this->model('deleteModel')->deleteOne("courses", $id);
        $result = $this->model('deleteModel')->deleteOne("clubs", $id);

        if ($result){
            $action = "Club deleted by admin";
            $status = "200";
            $this->model("createModel")->createLogEntry($action, $status);
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));
        }else{
        die(json_encode(array("status" => "400", "desc" => "Error while deleting post")));
        }
    }

    public function like($id = 0)
    {

        $this->requireLogin();
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
}