<?php
class AddCounselors extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/existingCounselors");
        die();
    }

    public function index($id = 0)
    {

        $this->requireLogin();
        if ($_SESSION["user_role"] != 1)
            $this->redirect();

        $data = [
            'title' => 'Counselors Adding',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["user_template"] = $this->model('readModel')->getEmptyUser();
        $data["counselor_template"] = $this->model('readModel')->getEmptyCounselor();

        $data["user"] = $data["user_template"]["empty"];
        $data["counselor"] = $data["counselor_template"]["empty"];

        $data["user_template"] = $data["user_template"]["template"];
        $data["counselor_template"] = $data["counselor_template"]["template"];

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
            $this->validate_template($values, $data["counselor_template"]);

            if ($id == 0){
                $result = false;
                $result1 = $this->model('createModel')->insert_db("user", $values, $data["user_template"]);
                if ($result1) {
                    $values["id"] = $this->model('readModel')->lastInsertedId("user" , "id");
                    // print_r($values["id"]);
                    $result2 = $this->model('createModel')->insert_db("counselor", $values, $data["counselor_template"]);
                    $result = $result1 && $result2;
                }
            }else{
                $result = false;
                $result1 = $this->model('updateModel')->update_one("user", $values, $data["user_template"], "id", $id, "i");
                if ($result1) {
                    $values["id"] = $id;
                    $result2 = $this->model('updateModel')->update_one("counselor", $values, $data["counselor_template"], "id", $id, "i");
                    $result = $result1 && $result2;
                }
            }
                
            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Error while creating user")));
        }

        if ($id != 0) {
            $data["user"] = $this->model('readModel')->getOne("user", $id);
            $data["counselor"] = $this->model('readModel')->getOne("counselor", $id);
            if (!($data["user"])&&($data["counselor"]))
                $this->redirect();
            // print_r($data["user"]);
            // die;
            if ($data["user"]["role"] != 5)
            if ($data["counselor"]["role"] != 1) {
                $this->redirect();
            }
        }

        $this->view->render('admin/addCounselors/index', $data);
    }
}
