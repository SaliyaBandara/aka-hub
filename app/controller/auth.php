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

                // check if email is verified
                if ($result["email_verified"] == 0) {
                    //log Entry
                    $action = "User tried to login with unverified email";
                    $status = "401";
                    $this->model("createModel")->createLogEntry($action, $status, $data["email"]);
                    die(json_encode(array("status" => "400", "desc" => "Please verify your email, We have sent you a verification email to your email address")));
                }


                // set session variables
                $_SESSION["logged_in"] = true;
                $_SESSION["user_id"] = $result["id"];
                $_SESSION["user_name"] = $result["name"];
                $_SESSION["user_email"] = $result["email"];
                $_SESSION["user_role"] = $result["role"];
                $_SESSION["user_img"] = $result["profile_img"];

                $_SESSION["student_rep"] = $result["student_rep"];
                $_SESSION["club_rep"] = $result["club_rep"];
                $_SESSION["teaching_student"] = $result["teaching_student"];


                if ($result["role"] == "1") {
                    //log Entry
                    $action = "User logged in as Admin with email";
                    $status = "603";
                    $this->model("createModel")->createLogEntry($action, $status);
                    die(json_encode(array("status" => "200", "desc" => "Successfully logged in", "redirect" => "/aka-hub/adminpanel")));
                } else if ($result["role"] == "3") {
                    //log Entry
                    $action = "User logged in as Super Admin with email";
                    $status = "603";
                    $this->model("createModel")->createLogEntry($action, $status);

                    die(json_encode(array("status" => "200", "desc" => "Successfully logged in", "redirect" => "/aka-hub/adminpanel")));
                } else if ($result["role"] == "5") {
                    //log Entry
                    $action = "User logged in as Counselor with email";
                    $status = "603";
                    $this->model("createModel")->createLogEntry($action, $status);
                    die(json_encode(array("status" => "200", "desc" => "Successfully logged in", "redirect" => "/aka-hub/counselorPanel")));
                } else {
                    //log Entry
                    $action = "User logged in as Student with email";
                    $status = "603";
                    $this->model("createModel")->createLogEntry($action, $status);

                    // get student details and set year
                    $student = $this->model('readModel')->getOne("student", $result["id"]);
                    $_SESSION["year"] = $student["year"];

                    die(json_encode(array("status" => "200", "desc" => "Successfully logged in", "redirect" => "/aka-hub/dashboard")));
                }
            }

            $emailExists = $this->model('readModel')->isEmailExist($data["email"]);
            if (!$emailExists) {
                //log Entry
                $action = "User entered invalid email";
                $status = "400";
                $this->model("createModel")->createLogEntry($action, $status);

                die(json_encode(array("status" => "400", "desc" => "Invalid email")));
            } else {
                //log Entry
                $action = "User entered invalid password";
                $status = "401";
                $this->model("createModel")->createLogEntry($action, $status, $data["email"]);

                die(json_encode(array("status" => "400", "desc" => "Invalid password")));
            }
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

            if (strlen($data["password"]) < 6)
                die(json_encode(array("status" => "400", "desc" => "Password must be at least 6 characters long")));

            if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $data["password"]))
                die(json_encode(array("status" => "400", "desc" => "Password must contain at least one special character")));
    

            

            // check if student id is valid
            $student_id = $data["student_id"];
            $email = $data["email"];

            $student_id_prefix = substr($student_id, 0, 4);
            $student_id_lower_case = strtolower(substr($student_id, 5, 2));
            $student_id_suffix = substr($student_id, 8, 3);
            $email_prefix = substr($email, 0, 4);
            $email_lower_case = substr($email, 4, 2);
            $email_suffix = substr($email, 6, 3);

            if (
                $email_prefix !== $student_id_prefix ||
                $email_lower_case !== $student_id_lower_case ||
                $email_suffix !== $student_id_suffix
            ) {
                die(json_encode(array("status" => "400", "desc" => "Email and student ID do not match")));
            }

            $result = $this->model('authModel')->register($data);
            if ($result) {
                // send email verification code
                $subject = "Confirm Your Email Address | Aka Hub";
                $message = file_get_contents('../public/email_templates/register_email.htm');
                $message = str_replace('{{name}}', $result["name"], $message);
                $email_link = BASE_URL . "/auth/verify_email/" . $result["email_verification_code"];
                $message = str_replace('{{email_link}}', $email_link, $message);

                // set session variables
                $_SESSION["logged_in"] = true;
                $_SESSION["user_id"] = $result["id"];
                $_SESSION["user_name"] = $result["name"];
                $_SESSION["user_email"] = $result["email"];
                $_SESSION["user_role"] = $result["role"];

                $_SESSION["student_rep"] = $result["student_rep"];
                $_SESSION["club_rep"] = $result["club_rep"];
                $_SESSION["teaching_student"] = $result["teaching_student"];

                //log Entry
                $action = "User Registered with email";
                $status = "600";
                $this->model("createModel")->createLogEntry($action, $status);

                ob_start();

                echo (json_encode(array("status" => "200", "desc" => "Successfully Registered", "register" => 1)));

                $this->model("createModel")->close_connection();

                // sendEmail($to, $name, $subject, $message)
                $this->model("createModel")->sendEmail($result["email"], $result["name"], $subject, $message);
            }

            //log Entry
            $action = "User tried to register with an existing email";
            $status = "400";
            $this->model("createModel")->createLogEntry($action, $status);

            die(json_encode(array("status" => "400", "desc" => "Email already exists")));
        } else
            die(json_encode(array("status" => "400", "desc" => "Please fill all the input fields")));
    }

    public function verify_email($code)
    {
        $result = $this->model('authModel')->verify_email($code);
        if ($result) {
            //log Entry
            $action = "User verified email with email";
            $status = "601";
            $this->model("createModel")->createLogEntry($action, $status);

            $data = [
                'title' => 'Email Verified',
                'message' => 'Welcome to Aka Hub!'
            ];

            $data["email_verified"] = 1;
            $this->view->render('auth/index', $data);
        } else {
            //log Entry
            $action = "User tried to verify email with invalid code";
            $status = "400";
            $this->model("createModel")->createLogEntry($action, $status);

            $data = [
                'title' => 'Email Verification Failed',
                'message' => 'Welcome to Aka Hub!'
            ];

            $data["email_verified"] = 2;
            $this->view->render('auth/index', $data);
        }
    }

    public function reset_password($token = "")
    {
        $required_vars = [
            "email" => "string"
        ];

        if (isset($_POST['action']) && $_POST['action'] == "reset_password") {
            $data = $_POST["data"];
            $this->validate($data, $required_vars);

            $result = $this->model('authModel')->reset_password($data["email"]);
            if ($result) {
                // $return_data = [
                //     "email" => $email,
                //     "name" => $result[0]["name"],
                //     "token" => $token
                // ];

                // send email verification code
                $subject = "Reset Your Password | Aka Hub";
                $message = file_get_contents('../public/email_templates/reset_password.htm');
                $message = str_replace('{{name}}', $result["name"], $message);
                $email_link = BASE_URL . "/auth/reset_password/" . $result["token"];
                $message = str_replace('{{email_link}}', $email_link, $message);

                //log Entry
                $action = "User requested to reset password with email";
                $status = "602";
                $this->model("createModel")->createLogEntry($action, $status);

                ob_start();

                echo (json_encode(array("status" => "200", "desc" => "Reset Password Email Sent")));

                $this->model("createModel")->close_connection();

                // sendEmail($to, $name, $subject, $message)
                $this->model("createModel")->sendEmail($result["email"], $result["name"], $subject, $message);
            }

            //log Entry
            $action = "User tried to reset password with invalid email";
            $status = "400";
            $this->model("createModel")->createLogEntry($action, $status);

            die(json_encode(array("status" => "400", "desc" => "Invalid email")));
        }

        if (isset($_POST['action']) && $_POST['action'] == "reset_password_save" && $token != "") {
            $data = $_POST["data"];
            $required_vars = [
                "password" => "string",
                "confirm_password" => "string"
            ];

            $this->validate($data, $required_vars);

            if ($data["password"] != $data["confirm_password"])
                die(json_encode(array("status" => "400", "desc" => "Passwords do not match")));

            $result = $this->model('authModel')->reset_password_change($token, $data["password"]);
            if ($result) {
                //log Entry
                $action = "User reset password with email";
                $status = "602";
                $this->model("createModel")->createLogEntry($action, $status);

                die(json_encode(array("status" => "200", "desc" => "Password Reset Successfully, Please login using your new password")));
            }

            //log Entry
            $action = "User tried to reset password with invalid token";
            $status = "400";
            $this->model("createModel")->createLogEntry($action, $status);

            die(json_encode(array("status" => "400", "desc" => "Invalid Reset Password Token")));
        }

        $data = [
            'title' => 'Reset Password',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["reset_password"] = 2;
        if ($token != "") {
            // check_valid_token
            $result = $this->model('authModel')->check_valid_token($token);
            if ($result)
                $data["reset_password"] = 1;
        }
        $this->view->render('auth/index', $data);
    }
}
