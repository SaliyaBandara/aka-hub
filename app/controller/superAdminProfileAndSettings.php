<?php
class SuperAdminProfileAndSettings extends Controller
{
    public function index()
    {
        $this->requireLogin();
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
        // if ($_SESSION["user_role"] != 0)
        //     $this->redirect();

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
}
