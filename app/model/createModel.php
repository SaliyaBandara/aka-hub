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
        return $this->db_handle->insert($query, $types, $params);
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

        if (!isset($_SESSION["count_dummy"]))
            $_SESSION["count_dummy"] = 0;

        $user_id = $id_arr[$_SESSION["count_dummy"]];
        $_SESSION["count_dummy"]++;

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
    }

    public function notification($type, $user_id, $title, $message, $link = "")
    {

        /*
        Type
            1 - Exam
            2 - Reminder
            3 - Events
            4 - Materials
            5 - Election
            6 - Counsellor Reservations - High Priority (Ignore Preference)
        */

        // CREATE TABLE notifications (
        //     id INT AUTO_INCREMENT PRIMARY KEY,
        //     user_id INT NOT NULL,
        //     title VARCHAR(255) NOT NULL,
        //     description TEXT DEFAULT NULL,
        //     type TINYINT(1) NOT NULL,
        //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     sent_email TINYINT(1) NOT NULL DEFAULT 0,
        //     viewed TINYINT(1) NOT NULL DEFAULT 0,
        //     FOREIGN KEY (user_id) REFERENCES user(id)
        // );

        $result = $this->insert_db("notifications", [
            "user_id" => $user_id,
            "title" => $title,
            "description" => $message,
            "type" => $type
        ], [
            "user_id" => ["type" => "number"],
            "title" => ["type" => "string"],
            "description" => ["type" => "string"],
            "type" => ["type" => "number"]
        ]);

        // TODO: 
        // handle notification preferences

        if ($result) {
            $notification_id = $this->db_handle->getLastInsertedID();
            if ($link != "")
                $link = BASE_URL . $link;

            $this->sendNotificationEmail($user_id, $title, $message, $link);
            return true;
        }


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

    public function sendNotificationEmail($user_id, $title, $message, $link)
    {
        $user = $this->getAllByColumn("user", "id", $user_id, "i")[0];
        $email = $user["email"];
        $name = $user["name"];

        $subject = $title;
        $message = file_get_contents('../public/email_templates/notification_email.htm');
        $message = str_replace('{{name}}', $name, $message);
        $message = str_replace('{{title}}', $title, $message);
        $message = str_replace('{{message}}', $message, $message);
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

    public function insert_db_return_id($table, $data, $template = []) //not working properly
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

        $query = "INSERT INTO $table ($columns) VALUES ($values)";

        $whether_inserted = $this->db_handle->insert($query, $types, $params);
        $returned_id = $this->db_handle->getLastInsertedID();

        return array($whether_inserted, $returned_id);
    }
}
