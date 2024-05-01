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
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to access Counselor Account Creation";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
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

            if (isset($values["password"]) && $values["password"] != "")
                $values["password"] = password_hash($values["password"], PASSWORD_DEFAULT);

            // check if valid email
            if (!filter_var($values["email"], FILTER_VALIDATE_EMAIL))
                die(json_encode(array("status" => "400", "desc" => "Please enter a valid email")));

            // check if valid alt email
            if (!filter_var($values["alt_email"], FILTER_VALIDATE_EMAIL))
                die(json_encode(array("status" => "400", "desc" => "Please enter a valid alt email")));

            // check if email already exists
            if ($id == 0) {
                $result = $this->model('readModel')->isEmailExist($values["email"]);
                if ($result)
                    die(json_encode(array("status" => "400", "desc" => "Email already exists")));
            } else {
                $result = $this->model('readModel')->isEmailExist($values["email"]);
                if ($result && $result[0]["id"] != $id)
                    die(json_encode(array("status" => "400", "desc" => "Email already exists")));
            }

            //check if valid phone number
            if (!preg_match("/^[0-9]{9}$/", $values["contact"]))
                die(json_encode(array("status" => "400", "desc" => "Please enter a valid phone number")));


            $this->validate_template($values, $data["user_template"]);
            $this->validate_template($values, $data["counselor_template"]);

            if ($id == 0) {
                $result = 0;
                $result1 = $this->model('createModel')->insert_db("user", $values, $data["user_template"]);
                if ($result1) {
                    $values["id"] = $result1;
                    $result2 = $this->model('createModel')->insert_db("counselor", $values, $data["counselor_template"]);
                    $result = $result1 && $result2;
                }
                if ($result) {
                    if ($result) {
                        //log Entry
                        $action = "Counselor Account Created for email : " . $values["email"];
                        $status = "600";
                        $this->model("createModel")->createLogEntry($action, $status);

                        //send email
                        $this->model("createModel")->notification(7, $values["id"], $_SESSION["user_id"], "Counselor Account Created for  mail " . $values["email"], "Counselor Account Created for email " . $values["email"] . " . Your Password will be " . $values["password"] . " . Please login to the system and change your password. ", 7);
                    }
                }
            } else {
                $result = 0;
                $result1 = $this->model('updateModel')->update_one("user", $values, $data["user_template"], "id", $id, "i");
                if ($result1) {
                    $values["id"] = $id;
                    $result2 = $this->model('updateModel')->update_one("counselor", $values, $data["counselor_template"], "id", $id, "i");
                    $result = $result1 && $result2;
                }
                if ($result) {
                    if ($result) {
                        //log Entry
                        $action = "Counselor Account Updated for email : " . $values["email"];
                        $status = "601";
                        $this->model("createModel")->createLogEntry($action, $status);
                    }
                }
            }

            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Error while creating user")));
        }

        if ($id != 0) {
            $data["user"] = $this->model('readModel')->getOne("user", $id);
            $data["counselor"] = $this->model('readModel')->getOne("counselor", $id);
            if (!($data["user"]) && ($data["counselor"]))
                $this->redirect();
            if ($data["user"]["role"] != 5) {
                $this->redirect();
            }
        }

        $this->view->render('admin/addCounselors/index', $data);
    }
}
