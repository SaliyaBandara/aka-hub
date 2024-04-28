<?php

class counselorSettings extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $action = "Unauthorized user tried to access Counselor Profile and Settings";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }

        $data = [
            'title' => 'Counselor Profile And Settings',
            'message' => 'Welcome to Aka Hub!'
        ];

        $user_id = $_SESSION['user_id'];

        $data["admin_details"] = $this->model("readModel")->getOneCounselor($user_id);
        $this->view->render('counselor/settings/index', $data);
    }

    public function add_edit($id)
    {
        $this->requireLogin();

        if ($_SESSION["user_id"] != $id) {
            $action = "Unauthorized user tried to edit Counselor Profile and Settings";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }

        $data = [
            'title' => 'Edit Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["counselor_profile_template"] = $this->model('readModel')->getEmptyCounselor();
        $data["user_template"] = $this->model('readModel')->getEmptyUser();

        $data["counselor_profile"] = $data["counselor_profile_template"]["empty"];
        $data["user"] = $data["user_template"]["empty"];

        $data["counselor_profile_template"] = $data["counselor_profile_template"]["template"];
        $data["user_template"] = $data["user_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];

            $this->validate_template($values, $data["counselor_profile_template"]);
            $this->validate_template($values, $data["user_template"]);

            $result1 = $this->model('updateModel')->update_one("counselor", $values, $data["counselor_profile_template"], "id", $id, "i");
            $result2 = $this->model('updateModel')->update_one("user", $values, $data["user_template"], "id", $id, "i");

            if ($result1 && $result2) {
                //log Entry
                $action = "Counselor successfully updated profile details " . $_SESSION['user_email'];
                $status = "601";
                $this->model("createModel")->createLogEntry($action, $status);
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));
            } else {
                die(json_encode(array("status" => "400", "desc" => "Error while " . "editing" . "ing profile")));
            }
        }
        $data["id"] = $id;

        if ($id != 0) {
            $data["counselor_profile"] = $this->model('readModel')->getOne("counselor", $id);
            $data["user"] = $this->model('readModel')->getOne("user", $id);
            // print_r($data["admin_profile"]);
            // print_r($data["user"]);
            // die();
            if (!$data["counselor_profile"])
                $this->redirect();
        }
        $this->view->render('counselor/settings/add_edit', $data);
    }
}
