<?php

class CounselorChat extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'CounselorChat',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/counselorChat/index', $data);
    }

    public function chat_users()
    {
        $data["messages"] = $this->model('readModel')->getAll("messages");
        session_start();
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];                              
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}");
        $output = "";

        if(mysqli_num_rows($sql) == 1){
            $output .= "No users are available to chat";
        }elseif(mysqli_num_rows($sql) > 0){
        include "data.php";
        }
        echo $output;
    }
}
