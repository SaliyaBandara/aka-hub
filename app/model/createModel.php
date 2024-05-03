<?php

class createModel extends Model
{
    protected $result;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_db($table, $data, $template = [])
    {
        $columns = "";
        $values = "";
        $types = "";
        $params = [];

        foreach ($data as $key => $value) {
            if ($value == "" || $value == null)
                continue;

            if (!isset($template[$key]) || !isset($template[$key]["type"]))
                continue;

            $columns .= $key . ",";
            $values .= "?,";
            // $types .= $value[1];
            $types .= $template[$key]["type"] == "number" ? "i" : "s";

            if (is_array($value))
                $value = implode(",", $value);
            array_push($params, $value);
        }

        $columns = rtrim($columns, ",");
        $values = rtrim($values, ",");

        // print_r($columns);
        // print_r($values);
        // print_r($types);
        // die;

        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $result = $this->db_handle->insert($query, $types, $params);
        // get last inserted id
        $last_id = $this->db_handle->getLastInsertedID();
        return $last_id;
    }

    public function insertChatMessage($outgoingId, $incomingId, $message, $template = [])
    {
        // print_r($outgoingId);
        // print_r($incomingId);
        // print_r($message);
        // die;

        $types = "";
        $params = [];

        $query = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES ({$incomingId}, {$outgoingId}, '{$message}')";
        $result = $this->db_handle->insert($query, $types, $params);
        // get last inserted id
        // $last_id = $this->db_handle->getLastInsertedID();
        // return $last_id;
    }


    // insert_multiple("calendar", $cleaned_timetable, $data["item_template"]);
    public function insert_multiple($table, $data, $template = [])
    {
        $columns = "";
        $values = "";
        $types = "";
        $params = [];

        // start transaction
        $this->start_transaction();

        $success = true;
        foreach ($data as $key => $value) {
            $columns = "";
            $values = "";
            $types = "";
            $params = [];

            foreach ($value as $key => $val) {
                if ($val == "" || $val == null)
                    continue;

                if (!isset($template[$key]) || !isset($template[$key]["type"]))
                    continue;

                $columns .= $key . ",";
                $values .= "?, ";
                $types .= $template[$key]["type"] == "number" ? "i" : "s";

                if (is_array($val))
                    $val = implode(",", $val);
                array_push($params, $val);
            }

            $columns = rtrim($columns, ",");
            $values = rtrim($values, ", ");

            $query = "INSERT INTO $table ($columns) VALUES ($values)";
            $result = $this->db_handle->insert($query, $types, $params);
            if (!$result) {
                $success = false;
                break;
            }
        }

        if ($success) {
            $this->commit_transaction();
            return true;
        }

        $this->rollback_transaction();
        return false;
    }

    // CREATE TABLE election_votes (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     election_id INT NOT NULL,
    //     user_id INT NOT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (election_id) REFERENCES elections(id),
    //     FOREIGN KEY (user_id) REFERENCES user(id)
    // );

    // -- election responses table

    // CREATE TABLE election_responses (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     election_id INT NOT NULL,
    //     user_id INT NOT NULL,
    //     question_id INT NOT NULL,
    //     response_option VARCHAR(255) DEFAULT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (election_id) REFERENCES elections(id),
    //     FOREIGN KEY (user_id) REFERENCES user(id),
    //     FOREIGN KEY (question_id) REFERENCES election_questions(id)
    // );

    // $this->model('createModel')->insert_election_answers($answers);
    // foreach ($question_answers as $key => $answer) {
    //     $answers[] = [
    //         "election_id" => $election_id,
    //         "user_id" => $user_id,
    //         "question_id" => $question_id,
    //         "answer" => $answer
    //     ];
    // }

    public function insert_election_answers($election_id, $answers, $election_response_template)
    {
        $this->start_transaction();

        $id_arr = [57, 2, 3, 4, 22, 58, 6, 5, 24, 23];
        $user_id = $_SESSION["user_id"];

        // if (!isset($_SESSION["count_dummy"]))
        //     $_SESSION["count_dummy"] = 0;

        // $user_id = $id_arr[$_SESSION["count_dummy"]];
        // $_SESSION["count_dummy"]++;

        // insert to election_votes
        $result = $this->insert_db("election_votes", [
            "election_id" => $election_id,
            "user_id" => $user_id
        ], [
            "election_id" => ["type" => "number"],
            "user_id" => ["type" => "number"]
        ]);

        if (!$result) {
            $this->rollback_transaction();
            return false;
        }

        // insert to election_responses
        if (count($answers) > 0) {
            foreach ($answers as $key => $answer) {
                $result = $this->insert_db("election_responses", [
                    "election_id" => $election_id,
                    "user_id" => $user_id,
                    "question_id" => $answer["question_id"],
                    "response_option" => $answer["answer"]
                ], $election_response_template);

                if (!$result) {
                    $this->rollback_transaction();
                    return false;
                }
            }
        }

        $this->commit_transaction();
        return true;
    }

    public function close_connection()
    {
        // header('Connection: close');
        // header('Content-Length: ' . ob_get_length());
        // ob_end_flush();
        // @ob_flush();
        // flush();
        // fastcgi_finish_request();
        // if (session_id()) session_write_close();

        // ob_start();

        $size = ob_get_length();

        header("Content-Encoding: none");
        header("Content-Length: {$size}");

        header("Connection: close");
        ob_end_flush();
        ob_flush();
        flush();
        if (session_id()) {
            session_write_close();
        }
    }

    public function notification($type, $id, $user_id, $title, $message, $target = 0, $link = "")
    {
        /*
        Sample Function Calls

        $this->model("createModel")->notification(7, 0, $id, "Student Representative Permissions Revoked","Sorry , Your Student Representative Permissions and Features Revoked", 0);

        $this->model("createModel")->notification(7, 0, $id, "Promoted to Club Representative","You Have Been Promoted to Club Representative Role and Features", 0);

        $this->model("createModel")->notification(7, $values["id"], $id, "Counselor Account Created for  mail " . $values["email"], "Counselor Account Created for email " . $values["email"] . " . Your Password will be " . $values["password"] . " . Please login to the system and change your password. ", 0);

        */


        /*
        Type
            1 - Exam
            2 - Reminder
            3 - Events
            4 - Materials
            5 - Election
            6 - Counsellor Reservations - High Priority (Ignore Preference)
            7 - misc - target only single user
        */

        // -- notifications table

        // -- Type
        // --     1 - Exam
        // --     2 - Reminder
        // --     3 - Events
        // --     4 - Materials
        // --     5 - Election

        // -- is_broadcast
        // --     0 - Personal
        // --     1 - Broadcast

        // -- Target
        // --    0 - All
        // --    5 - All Students
        // --      1 - Student - 1st Year
        // --      2 - Student - 2nd Year
        // --      3 - Student - 3rd Year
        // --      4 - Student - 4th Year
        // --      6 - Counsellor

        // CREATE TABLE notifications (
        //     id INT AUTO_INCREMENT PRIMARY KEY,
        //     is_broadcast TINYINT(1) NOT NULL DEFAULT 0,
        //     target TINYINT(1) NOT NULL DEFAULT 0,
        //     user_id INT DEFAULT NULL,
        //     parent_id INT DEFAULT NULL,
        //     title VARCHAR(255) NOT NULL,
        //     description TEXT DEFAULT NULL,
        //     link VARCHAR(255) DEFAULT NULL,
        //     type TINYINT(1) NOT NULL,
        //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     sent_email TINYINT(1) NOT NULL DEFAULT 0,
        //     viewed TINYINT(1) NOT NULL DEFAULT 0,
        //     FOREIGN KEY (user_id) REFERENCES user(id)
        // );


        $template = [
            "is_broadcast" => ["type" => "number"],
            "target" => ["type" => "number"],
            "user_id" => ["type" => "number"],
            "parent_id" => ["type" => "number"],
            "title" => ["type" => "string"],
            "description" => ["type" => "string"],
            "link" => ["type" => "string"],
            "type" => ["type" => "number"]
        ];

        // if election
        if ($type == 5) {
            $this->insert_db("notifications", [
                "is_broadcast" => 1,
                "target" => $target,
                "user_id" => $user_id,
                "parent_id" => $id,
                "title" => $title,
                "description" => $message,
                "link" => $link,
                "type" => $type
            ], $template);

            return true;
        }

        // Counsellor Reservations
        else if ($type == 6) {

            $this->insert_db("notifications", [
                "is_broadcast" => 0,
                "target" => 0,
                "user_id" => $user_id,
                "parent_id" => $id,
                "title" => $title,
                "description" => $message,
                "link" => $link,
                "type" => $type
            ], $template);

            $this->sendNotificationEmail($user_id, $title, $message, $link);
            return true;
        }

        // exam
        else if ($type == 1) {
            $this->insert_db("notifications", [
                "is_broadcast" => 1,
                "target" => $target,
                "user_id" => $user_id,
                "parent_id" => $id,
                "title" => $title,
                "description" => $message,
                "link" => $link,
                "type" => $type
            ], [
                "is_broadcast" => ["type" => "number"],
                "target" => ["type" => "number"],
                "user_id" => ["type" => "number"],
                "parent_id" => ["type" => "number"],
                "title" => ["type" => "string"],
                "description" => ["type" => "string"],
                "link" => ["type" => "string"],
                "type" => ["type" => "number"]
            ]);
        }

        // TODO: 
        // handle notification preferences

        // if ($result) {
        //     $notification_id = $this->db_handle->getLastInsertedID();
        //     if ($link != "")
        //         $link = BASE_URL . $link;

        //     $this->sendNotificationEmail($user_id, $title, $message, $link);
        //     return true;
        // }

        return true;
    }

    public function getEmailButton($link, $text)
    {
?>
        <p style="margin: 10px 0 0; text-align: left;">
            <a href="$link" style="display:inline-block;width: 90%;text-align:center;text-decoration: none; background:#ff9b2d;border-radius:3px;color:white;font-family: Helvetica, sans-serif;font-size:16px;line-height: 24px;font-weight:400;padding:12px 20px 11px;margin:0 auto;" target="_blank">
                <span style="font-weight: bold">$text</span>
            </a>
        </p>
<?php
    }

    public function sendNotificationEmail($user_id, $title, $message_str, $link = "")
    {
        $user = $this->getAllByColumn("user", "id", $user_id, "i")[0];
        $email = $user["email"];
        $name = $user["name"];

        $subject = $title;
        $message = file_get_contents('../public/email_templates/notification_email.htm');
        $message = str_replace('{{name}}', $name, $message);
        $message = str_replace('{{title}}', $title, $message);
        $message = str_replace('{{message}}', $message_str, $message);

        if ($link != "")
            $message = str_replace('{{link}}', $link, $message);

        $this->close_connection();
        $sendEmail = $this->sendEmail($email, $name, $subject, $message);
        if ($sendEmail)
            return true;

        return false;
    }

    public function sendEmail($to, $name, $subject, $message)
    {
        /*

        Usage

        $subject = "Confirm Your Email Address | Aka Hub";
        $email = "saliyab21@gmail.com";
        $name = "Saliya Bandara";
        $message = file_get_contents('../public/email_templates/register_email.htm');
        $message = str_replace('{{name}}', $name, $message);

        $sendEmail = $this->model('createModel')->sendEmail($email, $name, $subject, $message);
        if ($sendEmail)
            die(json_encode(array("status" => "200", "desc" => "Email sent successfully")));

        */

        global $mail;
        // $mail = new PHPMailer();
        $mail->IsSMTP();

        // STARTTLS
        // $mail->SMTPDebug  = 0;
        // $mail->SMTPDebug = 2;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";

        $mail->Port       = SMTP_PORT;
        $mail->Host       = SMTP_HOST;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;

        $mail->IsHTML(true);
        $mail->AddAddress($to, $name);
        $mail->SetFrom(SMTP_EMAIL, SMTP_TITLE);
        $mail->AddReplyTo(SMTP_EMAIL, SMTP_TITLE);

        // $mail->AddCC("cc-recipient-email", "cc-recipient-name");
        $mail->Subject = $subject;

        $mail->MsgHTML($message);
        if (!$mail->Send()) {
            // echo $mail->ErrorInfo;
            // var_dump($mail);
            return false;
        } else
            return true;
    }

    public function createLogEntry($action, $status, $tryEmail = "")
    {
        // 200 => "Success",
        // 201 => "Created",
        // 400 => "Bad Request",
        // 401 => "Unauthorized", 
        // 600 => "User Created",
        // 601 => "User Updated",
        // 602 => "User Deleted",
        // 603 => "User Logged In",
        // 604 => "User Logged Out",
        // 605 => "User Password Changed",
        // 606 => "User Granted Permission",
        // 607 => "User Revoked Permission"

        if (!file_exists("userlog.txt")) {
            file_put_contents("userlog.txt", "");
        }

        $ip = $_SERVER['REMOTE_ADDR'];
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING'];
        date_default_timezone_set("Asia/Colombo");
        $time = date("m/d/y h:iA", time());
        $contents = file_get_contents("userlog.txt");
        $email = isset($_SESSION["user_email"]) ? $_SESSION["user_email"] : "Not logged in";
        $contents .= "$email\t$ip\t$time\t$action\t$url\t$status\n\n";


        $lastIP = $this->getLastIP();
        $unauthorizedCount = (int)$this->getUnauthorizedCount();
        if ((($status === 401) || ($status === "401")) && ($ip === $lastIP)) {
            $unauthorizedCount += 1;
        } else {
            $unauthorizedCount = 0;
        }
        if ($unauthorizedCount > 10) {
            if (isset($_SESSION["user_id"])) {
                // $this->restrictUser($_SESSION["user_id"]);
                $this->sendEmail($_SESSION["user_email"], $_SESSION["name"], "We recognized series of unauthorized attempts.", "We regonized series of unauthorized attempts. Your account has been restricted for security reasons. Please contact the administrator for further information.");
                $this->notifyAdmins("User Account Restricted", "User account with email " . $_SESSION["user_email"] . " has been restricted due to series of unauthorized attempts.");
                session_destroy();
            } else {
                // $this->restrictUserByEMail($tryEmail);
                $tryName = $this->getNamesByEmail($tryEmail);
                $this->sendEmail($tryEmail, $tryName, "We recognized series of unauthorized attempts.", "We regonized series of unauthorized attempts. Your account has been restricted for security reasons. Please contact the administrator for further information.");
                $this->notifyAdmins("User Account Restricted", "User account with email " . $tryEmail . " has been restricted due to series of unauthorized attempts.");
            }
            $unauthorizedCount = 0;
        }
        $this->update_system_variable("unauthorizedCount", (string)$unauthorizedCount);
        $this->update_system_variable("lastUnauthorizedIP", $ip);


        file_put_contents("userlog.txt", $contents);
    }

    public function notifyAdmins($subject, $message)
    {
        $superAdmins = $this->getAllUserWithRole(3);
        $admins = $this->getAllUserWithRole(1);
        $recipients = array_merge($superAdmins, $admins);
        foreach ($recipients as $recipient) {
            $this->sendEmail($recipient['email'], $recipient["name"], $subject, $message);
        }
    }

    public function add_system_variable($name, $value)
    {
        $result = $this->insert_db("system_variables", [
            "name" => $name,
            "value" => $value
        ], [
            "name" => ["type" => "string"],
            "value" => ["type" => "string"]
        ]);

        return $result;
    }
}
