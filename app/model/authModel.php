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

    public function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet) - 1;
        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->cryptoRandSecure(0, $max)];
        }
        return $token;
    }

    public function cryptoRandSecure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) {
            return $min; // not so random...
        }
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
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
            "name" => [$data["fname"] . " " . $data["lname"], "s"],
            "profile_img" => ["avatar.png", "s"],
            "email_verified" => [0, "i"],
            "email_verification_code" => [$this->getToken(50), "s"],
        ];

        // print_r($data);

        $result = $this->insert_db("user", $data);

        if ($result) {

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
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE email = ? AND status = ?", "si", [$email, 1]);
        if (count($result) > 0 && password_verify($password, $result[0]["password"]))
            return $result[0];
        return false;
    }

    public function verify_email($code)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE email_verification_code = ?", "s", [$code]);
        if (count($result) > 0) {
            $this->db_handle->insert("UPDATE user SET email_verified = 1 WHERE email_verification_code = ?", "s", [$code]);
            return $result[0];
        }
        return false;
    }
}
