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
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5)){
            $task="Unauthorized user tried to access chat_users page for counselor.";
            $this->model("createModel")->createLogEntry($task, "401");
            $this->redirect();
        }
        
        $chat_users = $this->model('readModel')->getAllChatUsers("chat_users");
        // Return only the chat users data as JSON
        header('Content-Type: application/json');
        echo json_encode($chat_users);

    }

    public function chat_messages($id)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $task="Unauthorized user tried to access chat_messages page for counselor.";
            $this->model("createModel")->createLogEntry($task, "401");
            $this->redirect();
        }

        // // print_r($this->model('readModel')->getAllChatMessages("outgoing_id"));
        // $outgoing_id = $this->model('readModel')->getAllChatMessages("outgoing_id")[0]['outgoing_msg_id'];
        // $incoming_id = $this->model('readModel')->getAllChatMessages("incoming_id")[0]['incoming_msg_id'];

        // print_r($id);
 

        $user_id = $_SESSION["user_id"];
        $outgoing_id = $id;
        $incoming_id = $user_id;

        $messages = $this->model('readModel')->getAllChatMessagesById($outgoing_id, $incoming_id);

        if(is_array($messages)) { // Check if $messages is an array
            if(count($messages) > 0){
                $output = "";

                foreach($messages as $row){ 
                    if($row['outgoing_msg_id'] === $id){ 
                        $output .= '<div class="chat outgoing">
                                        <div class="details">
                                            <p>'. $row['msg'] .'</p>
                                        </div>
                                    </div>';
                    } else { 
                        $output .= '<div class="chat incoming">
                                        <img src="php/images/'. $row['img'] .'" alt="">
                                        <div class="details">
                                            <p>'. $row['msg'] .'</p>
                                        </div>
                                    </div>';
                    }
                }
                
                header('Content-Type: application/json');
                echo $output;
            } else {
                // Handle case when $messages is an empty array
                header('Content-Type: application/json');
                echo json_encode(["message" => "No messages found"]);
            }
        } else {
            // Handle case when $messages is not an array
            header('Content-Type: application/json');
            echo json_encode(["error" => "Messages not found"]);
        }
    }

}
