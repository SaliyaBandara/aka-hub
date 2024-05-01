<?php
class SuperAdminProfileAndSettings extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 3) {
            $task = "Unauthorized user tried to access SuperAdmin Profile And Settings";
            $this->model("createModel")->createLogEntry($task, 401);
            $this->redirect();
        }
        $data = [
            'title' => 'SuperAdmin Profile And Settings',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["super_admin_details"] = $this->model("readModel")->getUser($_SESSION['user_id']);
        $this->view->render('superadmin/superAdminProfileAndSettings/index', $data);
    }

    public function add_edit($id)
    {
        $this->requireLogin();
        if($_SESSION["user_id"] != $id){
            $task = "Unauthorized user tried to edit SuperAdmin Profile And Settings";
            $this->model("createModel")->createLogEntry($task, 401);
            $this->redirect();
        }

        $data = [
            'title' => 'Edit Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["user_template"] = $this->model('readModel')->getEmptyUser();
        $data["user"] = $data["user_template"]["empty"];
        $data["user_template"] = $data["user_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];

            $this->validate_template($values, $data["user_template"]);

            $result = $this->model('updateModel')->update_one("user", $values, $data["user_template"], "id", $id, "i");

            if ($result) {
                $task = "SuperAdmin edited profile";
                $this->model("createModel")->createLogEntry($task, 601);
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));
            } else {
                die(json_encode(array("status" => "400", "desc" => "Error while " . "editing" . "ing profile")));
            }
        }
        $data["id"] = $id;

        if ($id != 0) {
            $data["user"] = $this->model('readModel')->getOne("user", $id);
        }

        $this->view->render('superadmin/superAdminProfileAndSettings/add_edit', $data);
    }
    public function changePassword()
    {

        $this->requireLogin();

        $id = $_SESSION["user_id"];
        
        $user = $this->model('readModel')->getOne("user",$id);
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

            if($newPassword == ""){
                die(json_encode(array("status" => "400", "desc" => "New password cannot be blank!")));
            }
            if($oldPassword == ""){
                die(json_encode(array("status" => "400", "desc" => "Old password cannot be blank!")));
            }


            if(password_verify($oldPassword, $password)){
            // if($hashedOldPassword == $password){
                $values["password"] = $hashedNewPassword;
                $result = $this->model('updateModel')->update_one("user", $values, $data["user_template"], "id", $id, "i");

                if($result){
                    $task = "SuperAdmin changed his password";
                    $this->model("createModel")->createLogEntry($task, "605");
                    die(json_encode(array("status" => "200", "desc" => "Operation successful")));
                }
            }

            $task = "SuperAdmin tried to change his password but entered wrong old password";
            $this->model("createModel")->createLogEntry($task, "401");
            die(json_encode(array("status" => "403", "desc" => "Incorrect Old Password")));
        }

        $this->view->render('admin/superAdminProfileAndSettings/changePassword', $data);
    }
}
