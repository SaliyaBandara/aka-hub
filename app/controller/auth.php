<?php

class Auth extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('auth/index', $data);
    }

    public function login()
    {

        $required_vars = [
            "email" => "string",
            "password" => "string"
        ];

        if (isset($_POST['action']) && $_POST['action'] == "login") {
            $data = $_POST["data"];
            $this->validate($data, $required_vars);

            $result = $this->model('authModel')->login($data["email"], $data["password"]);
            if ($result) {
                // set session variables
                $_SESSION["logged_in"] = true;
                $_SESSION["user_id"] = $result["id"];
                $_SESSION["user_name"] = $result["name"];
                $_SESSION["user_email"] = $result["email"];
                $_SESSION["user_role"] = $result["role"];

                $_SESSION["student_rep"] = $result["student_rep"];
                $_SESSION["club_rep"] = $result["club_rep"];
                $_SESSION["teaching_student"] = $result["teaching_student"];


                if ($result["role"] == "1") {
                    die(json_encode(array("status" => "200", "desc" => "Successfully logged in", "redirect" => "/aka-hub/adminpanel")));
                } else if ($result["role"] == "3") {
                    die(json_encode(array("status" => "200", "desc" => "Successfully logged in", "redirect" => "/aka-hub/adminpanel")));
                } else if ($result["role"] == "5") {
                    die(json_encode(array("status" => "200", "desc" => "Successfully logged in", "redirect" => "/aka-hub/counselorPanel")));
                } else {
                    die(json_encode(array("status" => "200", "desc" => "Successfully logged in", "redirect" => "/aka-hub/dashboard")));
                }
            }

            die(json_encode(array("status" => "400", "desc" => "Invalid email or password")));
        } else
            die(json_encode(array("status" => "400", "desc" => "Please fill all the input fields")));
    }

    public function register()
    {

        $required_vars = [
            "student_id" => "string",
            "password" => "string",
            "email" => "string",
            "fname" => "string",
            "lname" => "string",
        ];

        if (isset($_POST['action']) && $_POST['action'] == "register") {
            $data = $_POST["data"];
            $this->validate($data, $required_vars);

            if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL))
                die(json_encode(array("status" => "400", "desc" => "Please enter a valid email")));

            // check if email has stu.ucsc.cmb.ac.lk at the end
            $pattern = '/@stu\.ucsc\.cmb\.ac\.lk$/i';
            if (!preg_match($pattern, $data["email"]))
                die(json_encode(array("status" => "400", "desc" => "Please enter a valid UCSC email")));

            $result = $this->model('authModel')->register($data);
            if ($result) {
                // TODO send email verification

                // set session variables
                $_SESSION["logged_in"] = true;
                $_SESSION["user_id"] = $result["id"];
                $_SESSION["user_name"] = $result["name"];
                $_SESSION["user_email"] = $result["email"];
                $_SESSION["user_role"] = $result["role"];

                $_SESSION["student_rep"] = $result["student_rep"];
                $_SESSION["club_rep"] = $result["club_rep"];
                $_SESSION["teaching_student"] = $result["teaching_student"];

                die(json_encode(array("status" => "200", "desc" => "Successfully Registered", "redirect" => "/aka-hub/dashboard")));
            }

            die(json_encode(array("status" => "400", "desc" => "Email already exists")));
        } else
            die(json_encode(array("status" => "400", "desc" => "Please fill all the input fields")));
    }
}
