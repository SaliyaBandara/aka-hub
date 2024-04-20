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

        $id = $_SESSION["user_id"];
        // print_r($id);
        $data["student_details"] = $this->model('readModel')->getUserDetails($id);
        $data["settings"] = $this->model('readModel')->getUserSettings($id);

        $this->view->render('student/studentProfile/index', $data);
    }

    // public function view($id = 0)
    // {
    //     $this->requireLogin();

    //     // if ($id == 0)
    //     //     $this->redirect();

    //     $data = [
    //         'title' => 'Student Profile',
    //         'message' => 'Welcome to Aka Hub!'
    //     ];

    //     $this->view->render('student/studentProfile/view', $data);
    // }

    public function add_edit($id)
    {
        $this->requireLogin();
        // if ($_SESSION["user_role"] != 0)
        //     $this->redirect();

        $data = [
            'title' => 'Edit Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["student_profile_template"] = $this->model('readModel')->getEmptyStudent();
        $data["user_template"] = $this->model('readModel')->getEmptyUser();


        $data["student_profile"] = $data["student_profile_template"]["empty"];
        $data["user"] = $data["user_template"]["empty"];


        $data["student_profile_template"] = $data["student_profile_template"]["template"];
        $data["user_template"] = $data["user_template"]["template"];

        // print_r($data["student_profile_template"]);

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];

            $this->validate_template($values, $data["student_profile_template"]);
            $this->validate_template($values, $data["user_template"]);

            if ($id == 0)
                $result = $this->model('createModel')->insert_db("student", $values, $data["student_profile_template"]);
            else
                $result1 = $this->model('updateModel')->update_one("student", $values, $data["student_profile_template"], "id", $id, "i");
                $result2 = $this->model('updateModel')->update_one("user", $values, $data["user_template"], "id", $id, "i");

            if ($result1 && $result2)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Error while " . $action . "ing profile")));
        }

        $data["id"] = $id;

        if ($id != 0) {
            $data["student_profile"] = $this->model('readModel')->getOne("student", $id);
            $data["user"] = $this->model('readModel')->getOne("user", $id);

            if (!$data["student_profile"])
                $this->redirect();
        }

        // print params
        // print_r($id);
        // print_r($action);

        $this->view->render('student/studentProfile/add_edit', $data);
    }

    public function add_edit_settings($id){
        $data = [
            'title' => 'Edit Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["settings_template"] = $this->model('readModel')->getEmptyNotificationSetting();
        $data["settings"] = $data["settings_template"]["empty"];
        $data["settings_template"] = $data["settings_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];

            $this->validate_template($values, $data["settings_template"]);

            $result = $this->model('updateModel')->update_one("notification_settings", $values, $data["settings_template"], "id", $id, "i");

            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Error while " . $action . "ing profile")));
        }

        $data["id"] = $id;

        if ($id != 0) {
            $data["settings"] = $this->model('readModel')->getOne("notification_settings", $id);

            if (!$data["settings"])
                $this->redirect();
        }

        $this->view->render('student/studentProfile/add_edit_settings', $data);
    }
}