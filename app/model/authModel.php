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

        $result = $this->insert_db("user", $data);
        if ($result) {
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
