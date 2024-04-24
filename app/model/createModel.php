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

        // insert to election_votes
        $result = $this->insert_db("election_votes", [
            "election_id" => $election_id,
            "user_id" => $_SESSION["user_id"]
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
                    "user_id" => $_SESSION["user_id"],
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
        header('Connection: close');
        header('Content-Length: ' . ob_get_length());
        ob_end_flush();
        @ob_flush();
        flush();
        fastcgi_finish_request();
        if (session_id()) session_write_close();
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

    public function createLogEntry($action , $status)
    {
        // 200 => "Success",
        // 201 => "Created",
        // 401 => "Unauthorized", 


        if (!file_exists("userlog.txt")) {
            file_put_contents("userlog.txt", "");
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'];
        date_default_timezone_set("Asia/Colombo");
        $time = date("m/d/y h:iA", time());
        $contents = file_get_contents("userlog.txt");
        $email = isset($_SESSION["user_email"]) ? $_SESSION["user_email"] : "Not logged in";
        $contents .= "User: $email\t IP: $ip\t Time: $time\t Action: $action\t URL: $url\t Status: $status\n";
        file_put_contents("userlog.txt", $contents);
    }
}
