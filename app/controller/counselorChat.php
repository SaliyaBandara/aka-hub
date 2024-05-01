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
        
        // $chat_users = $this->model('readModel')->getAllChatUsers("chat_users");
        $chat_users = $this->model('readModel')->getAllStudentChatUsers();

        if(is_array($chat_users)) { // Check if $messages is an array
            if(count($chat_users) > 0){
                $output = "";

                

                foreach($chat_users as $chat_user){ 

                    $role = "Student";
                    if($chat_user["role"] == 5){
                        $role = "Counselor";
                    }

                    $img_src = USER_IMG_PATH . $chat_user["profile_img"];
                    

                    $output .='<a href="#" class="user-card" id="'.$chat_user["unique_id"] .'" userId="'.$chat_user["unique_id"] .'">
                                    <div class="content">
                                        <img src="'. $img_src.'" alt="">
                                        <div class="details">
                                            <span>'.$chat_user["name"] .'</span>
                                            <p>'.$role.'</p>
                                        </div>
                                    </div>
                                </a>';
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
            // echo json_encode(["error" => "Messages not found"]);
        }
        // // Return only the chat users data as JSON
        // header('Content-Type: application/json');
        // echo json_encode($chat_users);

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

        // print_r($messages);
        // die;

        if(is_array($messages)) { // Check if $messages is an array
            if(count($messages) > 0){
                $output = "";

                foreach($messages as $row){ 

                    

                    $img_src = USER_IMG_PATH . $row["profile_img"];
                    if($row['outgoing_msg_id'] != $id){ 
                        $output .= '<div class="chat outgoing">
                                        <div class="details">
                                            <p>'. $row['msg'] .'</p>
                                        </div>
                                    </div>';
                    } else { 
                        $output .= '<div class="chat incoming">
                                        <img src="'. $img_src.'" alt="">
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
            // echo json_encode(["error" => "Messages not found"]);
        }
    }

    public function chat_header($id){
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $this->redirect();
        }

        $incoming_id = $id;

        
        $user = $this->model('readModel')->getOne("user", $incoming_id);
        // $user = $this->model('readModel')->getOneChatUser($outgoing_id);

        if(is_array($user)){
            $output = "";
            $img_src = USER_IMG_PATH . $user["profile_img"];
            $role = "Student";
            if($user["role"] == 5){
                $role = "Counselor";
            }
            $output .= '<header>
                            <img src="'. $img_src .'" alt="">
                            <div class="details">
                                <span>'. $user["name"].'</span>
                                <p>'. $role.'</p>
                            </div>
                        </header>';
            header('Content-Type: application/json');
            echo $output;
        } else {
            header('Content-Type: application/json');
            echo json_encode(["error" => "User not found"]);
        }

        // echo'<header>
        //         <img src="https://www.davidchang.ca/wp-content/uploads/2020/09/David-Chang-Photography-Headshots-Toronto-61-1024x1024.jpg" alt="">
        //         <div class="details">
        //             <span>Virajith Dissanayaka</span>
        //             <p>Active Now</p>
        //         </div>
        //     </header>';

    }

    public function insertChatMessages($id)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $this->redirect();
        }

        // Get sender ID from session
        $outgoingId = $_SESSION["user_id"];
        // Get recipient ID from function parameter
        $incomingId = $id;
        // Get message from POST data
        // print_r($_POST);
        // die();

        $message = $_POST['message'];
        $message = $this->model('readModel')->encrypt($message);

        // print_r($message );
        // print_r($incomingId );
        // die();

        // Now you can process the message, e.g., store it in the database
        // $this->model('createModel')->insertChatMessage($outgoingId, $incomingId, $message);

        $data["message_template"] = $this->model('readModel')->getEmptyMessage();
        $data["message"] = $data["message_template"]["empty"];
        $data["message_template"] = $data["message_template"]["template"];
        
        if (isset($_POST["message"])) {
            $values["outgoing_msg_id"] = $outgoingId;
            $values["incoming_msg_id"] = $incomingId;
            $values["msg"] = $message;

            // print_r($values);

            $this->validate_template($values, $data["message_template"]);
            // print_r($this->validate_template($values, $data["message_template"]));
            // die();

            $this->model('createModel')->insert_db("messages", $values, $data["message_template"]);

        }
    }


}
