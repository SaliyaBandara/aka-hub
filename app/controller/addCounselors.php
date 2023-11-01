<?php
class AddCounselors extends Controller
{

    public function redirect($redirect = "")
    {
<<<<<<< HEAD
        header("Location: " . BASE_URL . "/existingCounselors");
        die();
    }

    public function index($id = 0)
    {

        $this->requireLogin();
        if ($_SESSION["user_role"] != 1)
            $this->redirect();

=======
        $this->requireLogin();
>>>>>>> 8b281836935fd6cfa559f6c17eca18c58a6f7644
        $data = [
            'title' => 'Counselors Adding',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["user_template"] = $this->model('readModel')->getEmptyUser();
        $data["user"] = $data["user_template"]["empty"];
        $data["user_template"] = $data["user_template"]["template"];
        $data["id"] = $id;

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];

            $values["role"] = 5;
            $values["status"] = 1;
            if(isset($values["password"]) && $values["password"] != "")
                $values["password"] = password_hash($values["password"], PASSWORD_DEFAULT);

            // check if valid email
            if (!filter_var($values["email"], FILTER_VALIDATE_EMAIL))
                die(json_encode(array("status" => "400", "desc" => "Please enter a valid email")));

            $this->validate_template($values, $data["user_template"]);

            if ($id == 0)
                $result = $this->model('createModel')->insert_db("user", $values, $data["user_template"]);
            else
                $result = $this->model('updateModel')->update_one("user", $values, $data["user_template"], "id", $id, "i");

            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Error while creating user")));
        }

        if ($id != 0) {
            $data["user"] = $this->model('readModel')->getOne("user", $id);
            if (!$data["user"])
                $this->redirect();

            // print_r($data["user"]);
            // die;

            if ($data["user"]["role"] != 5)
                $this->redirect();
        }

        $this->view->render('admin/addCounselors/index', $data);
    }
<<<<<<< HEAD
}
=======

    public function test(){
        $this->requireLogin();
        $data = [
            'title' => 'Counselors Adding',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/addCounselors/test', $data);
    }

}
>>>>>>> 8b281836935fd6cfa559f6c17eca18c58a6f7644
