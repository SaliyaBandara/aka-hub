<?php

class authModel extends Model
{
    protected $result;

    public function __construct()
    {
        parent::__construct();
    }

    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function register($data)
    {
        $data["password"] = $this->hashPassword($data["password"]);

        // check if email already exists
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE email = ?", "s", [$data["email"]]);
        if (count($result) > 0)
            return false;

        $data = [
            "student_id" => [$data["student_id"], "s"],
            "password" => [$data["password"], "s"],
            "email" => [$data["email"], "s"],
            "name" => [$data["fname"] . " " . $data["lname"], "s"]
        ];

        // print_r($data);

        $result = $this->insert_db("user", $data);

        if($result){

            $newID = $this->db_handle->runQuery("SELECT id FROM  user WHERE ? ORDER BY id DESC LIMIT 1", "i", [1]);
            // print_r($newID);

            $email = $data["email"][0];
            $emailParts = explode('@', $email);
            if (count($emailParts) === 2) {
                $firstHalf = $emailParts[0];
                $containsCS = strpos($firstHalf, 'cs') !== false;
                $containsIS = strpos($firstHalf, 'is') !== false;
                if ($containsCS) {
                    $degree = "Computer Systems";
                } elseif ($containsIS) {
                    $degree = "Information Systems";
                }
            }

            $yearFromEmail = substr($email, 0, 4);
            $currentYear = date("Y");
            $studentYear = $currentYear - $yearFromEmail;

            $dataStudent = [
                "id" => [$newID[0]['id'], "i"],
                "degree" => [$degree, "s"],
                "index_number" => [" ", "s"],
                "year" => [$studentYear, "i"]
            ];

            // print_r($dataStudent);

            $dataNotification = [
                "id" => [$newID[0]['id'], "i"]
            ];

            // print_r($dataNotification);

            $resultStudent = $this->insert_db("student", $dataStudent);
            $resultNotification = $this->insert_db("notification_settings", $dataNotification);

        }


        if ($result && $resultStudent && $resultNotification) {
            // echo $data["email"][0];
            $result = $this->db_handle->runQuery("SELECT * FROM user WHERE email = ?", "s", [$data["email"][0]]);
            // print_r($result);
            return $result[0];
        }       

        return false;
    }

    public function login($email, $password)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE email = ?", "s", [$email]);
        if (count($result) > 0 && password_verify($password, $result[0]["password"]))
            return $result[0];

        return false;
    }
}
