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

        $data["counselor_details"] = $this->model("readModel")->getOneCounselor($user_id);
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
    
    public function changePassword()
    {

        $this->requireLogin();

        $id = $_SESSION["user_id"];

        $user = $this->model('readModel')->getOne("user", $id);
        $password = $user["password"];

        $data = [
            'title' => 'Edit Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["user_template"] = $this->model('readModel')->getEmptyUser();
        $data["user"] = $data["user_template"]["empty"];
        $data["user_template"] = $data["user_template"]["template"];

        if (isset($_POST['changePassword'])) {

            $oldPassword = $_POST["oldPassword"];
            $newPassword = $_POST["newPassword"];


            // trim
            $oldPassword = trim($oldPassword);
            $newPassword = trim($newPassword);

            // $hashedOldPassword = $this->model('authModel')->hashPassword($oldPassword);
            $hashedNewPassword = $this->model('authModel')->hashPassword($newPassword);
            // echo "$hashedOldPassword\n$password";
            // die;

            if ($newPassword == "") {
                die(json_encode(array("status" => "400", "desc" => "New password cannot be blank!")));
            }
            if ($oldPassword == "") {
                die(json_encode(array("status" => "400", "desc" => "Old password cannot be blank!")));
            }


            if (password_verify($oldPassword, $password)) {
                // if($hashedOldPassword == $password){
                $values["password"] = $hashedNewPassword;
                $result = $this->model('updateModel')->update_one("user", $values, $data["user_template"], "id", $id, "i");

                if ($result) {
                    $task = "Counselor changed his password";
                    $this->model("createModel")->createLogEntry($task, "605");
                    die(json_encode(array("status" => "200", "desc" => "Operation successful")));
                }
            }
            $task = "Counselor tried to change his password but entered wrong old password";
            $this->model("createModel")->createLogEntry($task, "401");
            die(json_encode(array("status" => "403", "desc" => "Incorrect Old Password")));
        }

        $this->view->render('counselor/settings/changePassword', $data);
    }
}
