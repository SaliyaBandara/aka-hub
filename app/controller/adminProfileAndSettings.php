<?php
class AdminProfileAndSettings extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to access Admin Profile and Settings";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }

        $data = [
            'title' => 'Admin Profile And Settings',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["admin_details"] = $this->model("readModel")->getOneAdmin($_SESSION['user_id']);
        $this->view->render('admin/adminProfileAndSettings/index', $data);
    }

    public function add_edit($id)
    {
        $this->requireLogin();

        if ($_SESSION["user_id"] != $id) {
            $action = "Unauthorized user tried to edit Admin Profile and Settings";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }

        $data = [
            'title' => 'Edit Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["admin_profile_template"] = $this->model('readModel')->getEmptyAdmin();
        $data["user_template"] = $this->model('readModel')->getEmptyUser();

        $data["admin_profile"] = $data["admin_profile_template"]["empty"];
        $data["user"] = $data["user_template"]["empty"];

        $data["admin_profile_template"] = $data["admin_profile_template"]["template"];
        $data["user_template"] = $data["user_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];

            $this->validate_template($values, $data["admin_profile_template"]);
            $this->validate_template($values, $data["user_template"]);

            $result1 = $this->model('updateModel')->update_one("administrator", $values, $data["admin_profile_template"], "id", $id, "i");
            $result2 = $this->model('updateModel')->update_one("user", $values, $data["user_template"], "id", $id, "i");

            if ($result1 && $result2) {
                //log Entry
                $action = "Admin successfully updated profile details " . $_SESSION['user_email'];
                $status = "601";
                $this->model("createModel")->createLogEntry($action, $status);
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));
            } else {
                die(json_encode(array("status" => "400", "desc" => "Error while " . "editing" . "ing profile")));
            }
        }
        $data["id"] = $id;

        if ($id != 0) {
            $data["admin_profile"] = $this->model('readModel')->getOne("administrator", $id);
            $data["user"] = $this->model('readModel')->getOne("user", $id);
            // print_r($data["admin_profile"]);
            // print_r($data["user"]);
            // die();
            if (!$data["admin_profile"])
                $this->redirect();
        }
        $this->view->render('admin/adminProfileAndSettings/add_edit', $data);
    }
}
