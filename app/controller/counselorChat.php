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
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        
        $chat_users = $this->model('readModel')->getAllChatUsers("chat_users");
        // Return only the chat users data as JSON
        header('Content-Type: application/json');
        echo json_encode($chat_users);
    }

    public function chat_messages()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $this->redirect();
        }
        $outgoing_id = $this->model('readModel')->getAllChatMessages("outgoing_id");
        $incoming_id = $this->model('readModel')->getAllChatMessages("incoming_id");

        $messages = $this->model('readModel')->getAllChatMessagesById($outgoing_id, $incoming_id);

        if(isset($_SESSION['unique_id'])){
            // $outgoing_id = $this->model('readModel')->getAllChatMessages("outgoing_id");
            // $incoming_id = $this->model('readModel')->getAllChatMessages("incoming_id");
            $output = "";

            // $messages = $this->model('readModel')->getAllChatMessagesById($outgoing_id, $incoming_id);
    
            if(mysqli_num_rows($messages) > 0){
                while($row = mysqli_fetch_assoc($messages)){
                    if($row['outgoing_msg_id'] === $outgoing_id){ // if this is equal to then he is a msg sender
                        $output .= '<div class="chat outgoing">
                                        <div class="details">
                                            <p>'. $row['msg'] .'</p>
                                        </div>
                                    </div>';
                    }else{ // he is a msg receiver
                        $output .= '<div class="chat incoming">
                                        <img src="php/images/'. $row['img'] .'" alt="">
                                        <div class="details">
                                            <p>'. $row['msg'] .'</p>
                                        </div>
                                    </div>';
                    }
                }
                // // Return the chat messages as JSON
                // header('Content-Type: application/json');
                // echo json_encode($output);
            } 
            // Return the chat messages as JSON
            header('Content-Type: application/json');
            echo json_encode($messages);

        }

    }
}
