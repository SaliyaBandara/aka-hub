<?php
class StudentProfile extends Controller{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/studentProfile");
        die();
    }

    public function index()
    {
        $this->requireLogin();

        $data = [
            'title' => 'Student Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["user_role"] = $_SESSION["user_role"];
        $data["student_profile"] = $this->model('readModel')->getAll("student_profile");
        $this->view->render('student/studentProfile/index', $data);
    }

    public function view($id = 0)
    {
        $this->requireLogin();

        // if ($id == 0)
        //     $this->redirect();

        $data = [
            'title' => 'Student Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["user_role"] = $_SESSION["user_role"];
        $data["id"] = $id;
        $data["student_profile"] = $this->model('readModel')->getOne("student_profile", $id);
        if (!$data["student_profile"])
            $this->redirect();

        // print_r($data["material"]);

        // $data["course"] = $this->model('readModel')->getOne("courses", $id);
        // if (!$data["course"])
        //     $this->redirect();

        $this->view->render('student/studentProfile/view', $data);
    }

    public function add_edit($id = 0, $action = "create")
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 0)
            $this->redirect();

        $data = [
            'title' => ($action == "create") ? 'Student Profile' : 'Edit Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["student_profile_template"] = $this->model('readModel')->getEmptyStudentProfile();
        $data["student_profile"] = $data["student_profile_template"]["empty"];
        $data["student_profile_template"] = $data["student_profile_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];
            $this->validate_template($values, $data["student_profile_template"]);

            if ($id == 0)
                $result = $this->model('createModel')->insert_db("student_profile", $values, $data["student_profile_template"]);
            else
                $result = $this->model('updateModel')->update_one("student_profile", $values, $data["student_profile_template"], "id", $id, "i");

            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Error while " . $action . "ing profile")));
        }

        $data["id"] = $id;
        $data["action"] = $action;

        if ($id != 0) {
            $data["student_profile"] = $this->model('readModel')->getOne("student_profile", $id);
            if (!$data["student_profile"])
                $this->redirect();
        }

        // print params
        // print_r($id);
        // print_r($action);

        $this->view->render('student/studentProfile/add_edit', $data);
    }

}