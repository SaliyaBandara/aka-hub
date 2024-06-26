<?php
class StudentProfile extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/studentProfile");
        die();
    }

    public function index()
    {
        $this->requireLogin();

        if($_SESSION["user_role"] != 0){
            $this->redirect();
        }

        $data = [
            'title' => 'Student Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $id = $_SESSION["user_id"];
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
        if ($_SESSION["user_id"] != $id){
            $action = "Unauthorized user tried to edit Student profile";
            $state = 401;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
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

            if ($id == 0) {
                $result = $this->model('createModel')->insert_db("student", $values, $data["student_profile_template"]);
                if ($result){
                    $task = "Student profile created";
                    $this->model("createModel")->createLogEntry($task, 201);

                    die(json_encode(array("status" => "200", "desc" => "Operation successful")));
                }else
                    die(json_encode(array("status" => "400", "desc" => "Error while " . "editing" . "ing profile")));
            } else {
                $result1 = $this->model('updateModel')->update_one("student", $values, $data["student_profile_template"], "id", $id, "i");
                $result2 = $this->model('updateModel')->update_one("user", $values, $data["user_template"], "id", $id, "i");

                // update the profile image in session variable
                if (isset($values["profile_img"])){
                    $_SESSION["user_img"] = $values["profile_img"][0];
                }

                if ($result1 && $result2){
                    $task = "Student profile edited";
                    $this->model("createModel")->createLogEntry($task, 200);
                    die(json_encode(array("status" => "200", "desc" => "Operation successful")));
                }else{
                    die(json_encode(array("status" => "400", "desc" => "Error while editing profile")));
                }
            }
        }

        $data["id"] = $id;

        if ($id != 0) {
            $data["student_profile"] = $this->model('readModel')->getOne("student", $id);
            $data["user"] = $this->model('readModel')->getOne("user", $id);

            if (!$data["student_profile"])
                $this->redirect();
        }

        $this->view->render('student/studentProfile/add_edit', $data);
    }

    public function add_edit_settings($id)
    {

        $this->requireLogin();
        if ($_SESSION["user_id"] != $id){
            $action = "Unauthorized user tried to edit Student settings";
            $state = 401;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        $data = [
            'title' => 'Edit Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["settings_template"] = $this->model('readModel')->getEmptyNotificationSetting();
        $data["settings"] = $data["settings_template"]["empty"];
        $data["settings_template"] = $data["settings_template"]["template"];

        $data["settings_template"]["id"] = $id;

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];

            $values['exam_notify'] = json_encode($values['exam_notify']);
            $values['reminder_notify'] = json_encode($values['reminder_notify']);
            $values['events_notify'] = json_encode($values['events_notify']);
            $values['materials_notify'] = json_encode($values['materials_notify']);

            // $this->validate_template($values, $data["settings_template"]);

            $result = $this->model('updateModel')->update_one("notification_settings", $values, $data["settings_template"], "id", $id, "i");

            if ($result){
                $task = "Student settings edited";
                $this->model("createModel")->createLogEntry($task, 601);
                
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));
            }
            die(json_encode(array("status" => "400", "desc" => "Error while " . "editing" . "ing profile")));
        }

        $data["id"] = $id;

        if ($id != 0) {
            $data["settings"] = $this->model('readModel')->getUserSettings($id);
            // print_r($data["settings"]);

            if (!$data["settings"])
                $this->redirect();
        }

        $this->view->render('student/studentProfile/add_edit_settings', $data);
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

            if (strlen($newPassword) < 6)
                die(json_encode(array("status" => "400", "desc" => "Password must be at least 6 characters long")));

        // Check if password contains at least one special character
            if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $newPassword))
                die(json_encode(array("status" => "400", "desc" => "Password must contain at least one special character")));



            if(password_verify($oldPassword, $password)){
            // if($hashedOldPassword == $password){
                $values["password"] = $hashedNewPassword;
                $result = $this->model('updateModel')->update_one("user", $values, $data["user_template"], "id", $id, "i");

                if($result){
                    $task = "Student changed his password";
                    $this->model("createModel")->createLogEntry($task, 605);
                    die(json_encode(array("status" => "200", "desc" => "Operation successful")));
                }
            }
            $task = "Student tried to change his password but entered wrong old password";
            $this->model("createModel")->createLogEntry($task, 401);
            die(json_encode(array("status" => "403", "desc" => "Incorrect Old Password")));
        }

        $this->view->render('student/studentProfile/changePassword', $data);
    }
}
