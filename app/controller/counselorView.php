<?php

class CounselorView extends Controller
{
    public function index($id = 0)
    {
        $this->requireLogin();
        $data = [
            'title' => 'Counselor Details',
            'message' => 'Welcome to Aka Hub!'
        ];


        $data["counselor"] = $this->model('readModel')->getOneCounselor($id);
        $data["posts"] = $this->model('readModel')->getCounselorPosts(1, $id);
        $this->view->render('student/counselor/view', $data);
    }

    public function bookReservation($id = 0)

    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 0){
            $action = "Unauthorized User tried to book reservation without permission";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'Counselor Details',
            'message' => 'Welcome to Aka Hub!'
        ];    

        $data["reservation_data"] = $this->model('readModel')->getEmptyReservation();
        $data["reservation"] = $data["reservation_data"]["empty"];
        $data["reservation_template"] = $data["reservation_data"]["template"];


        if (isset($_POST['timeslot_id'])) {

            $data["user_id"] = $_SESSION["user_id"];
            $data["student"] = $this->model('readModel')->getOne("user", $data["user_id"]);
            $data["timeslot"] = $this->model('readModel')->getOne("timeslots", $id);

            if($data["timeslot"] == null || $data["student"] == null)
                die(json_encode(array("status" => "400", "desc" => "Invalid request")));

            $data["timeSlot_data"] = $this->model('readModel')->getEmptyTimeSlot();
            $data["timeSlot"] = $data["timeSlot_data"]["empty"];
            $data["timeSlot_template"] = $data["timeSlot_data"]["template"];

            $data["values"] = $this->model('readModel')->getOne("timeslots", $id);
            if($data["values"] == null) 
                die(json_encode(["status" => 400, "desc" => "Time slot not found."]));

            $data["values"]["status"] = 3;    

            $result1 = $this->model('updateModel')->update_one("timeslots", $data["values"], $data["timeSlot_template"], "id", $id, "i");
          
            $data["reservation"]["timeslot_id"] = $id; 
            $data["reservation"]["student_id"] = $_SESSION["user_id"];

            //status = 0 => created
            //status = 1 => accepted
            //status = 2 => declined
            //status = 3 => accepted and completed
            //status = 4 => accepted and canceled

            $isValidated = $this->validate_template( $data["reservation"], $data["reservation_template"]);
            // print_r($isValidated);
            $result = $this->model('createModel')->insert_db("reservation_requests",  $data["reservation"] , $data["reservation_template"]);

            if ($result && $result1){
                $action  = "Reservation created by student";
                $status = "201";
                $this->model("createModel")->createLogEntry($action, $status);
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));
            }
            die(json_encode(array("status" => "400", "desc" => "Error while booking reservation")));
        }


        $data["timeslots"] = $this->model('readModel')->getNotBookedTimeSlotsByCounselorId($id);
        $data["counselor"] = $this->model('readModel')->getOneCounselor($id);

        $data["latestReservation"] = $this->model('readModel')->getLatestReservation($_SESSION["user_id"], $id);

        // print_r($data["counselor"]);

        $this->view->render('student/counselor/bookReservation', $data);
    }

    public function chatWithCounselor($id)
    {
        

        $this->requireLogin();
        if ($_SESSION["user_role"] != 0){
            $action = "Unauthorized User tried to chat with counselor without permission";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'Counselor Chat',
            'message' => 'Welcome to Aka Hub!'
        ];    

        // print_r($id);
        // die();

        $user_id = $_SESSION["user_id"];

        $data["user"] = $this->model('readModel')->getOne("user", $id);

        $this->view->render('student/counselor/chat', $data);
    }

    public function getChatHTML($id = 0){
        $this->requireLogin();
        if ($_SESSION["user_role"] != 0){
            $action = "Unauthorized User tried to chat with counselor without permission";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'Counselor Chat',
            'message' => 'Welcome to Aka Hub!'
        ];    

        // print_r($id);
        // die();

        $user_id = $_SESSION["user_id"];
        $outgoing_id = $user_id;
        $incoming_id = $id;

        $data["user"] = $this->model('readModel')->getOne("user", $id);
        $messages = $this->model('readModel')->getAllChatMessagesById($outgoing_id, $incoming_id);

        $user = $data["user"];

        // if(is_array($user)){
        //     $output = "";
        //     $img_src = USER_IMG_PATH . $user["profile_img"];
            

        //         echo'
        //             <div class="chat-box">';
        //             foreach ($messages as $message) {
        //                 if($message['outgoing_msg_id'] != $id){ 
        //                     echo '<div class="chat outgoing">
        //                                     <div class="details">
        //                                         <p>'. $message['msg'] .'</p>
        //                                     </div>
        //                                 </div>';
        //                 } else { 
        //                     echo '<div class="chat incoming">
        //                                     <img src="'. $img_src.'" alt="">
        //                                     <div class="details">
        //                                         <p>'. $message['msg'] .'</p>
        //                                     </div>
        //                                 </div>';
        //                 }
        //             }
        //         echo ' </div>';   
        // }

        if(is_array($messages)) { // Check if $messages is an array
            if(count($messages) > 0){
                $output = "";

                $img_src = USER_IMG_PATH . $user["profile_img"];
                foreach($messages as $row){ 

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

    public function insertChatMessages($id)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $this->redirect();
        }

        $outgoingId = $_SESSION["user_id"];
        $incomingId = $id;

        $message = $_POST['message'];
        $message = $this->model('readModel')->encrypt($message);

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
        // Send a response if needed
        // echo json_encode(["success" => true]);
        // Don't forget to exit to prevent further execution
        // exit();
    }





    public function checkExistingReservations()
    {
        $this->requireLogin();

        $data = [
            'title' => 'Counselor Details',
            'message' => 'Welcome to Aka Hub!'
        ];

        $user_id = $_SESSION["user_id"]; 
        
        // print_r($user_id);
        // die;
    
        $result = $this->model('readModel')->checkExistingReservations($user_id);

        // print_r($data["reservation"]);
        // die;

        if ($result) {
            die(json_encode(["status" => 200, "desc" => "You have an existing reservation. Cannot make a new reservation."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "There are no existing reservations."]));
        }
    }

    public function viewBookings($counselor_id)
    {
        $this->requireLogin();

        $data = [
            'title' => 'Counselor Details',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["reservations"] = $this->model('readModel')->getReservationsByStudent($_SESSION["user_id"],(int)$counselor_id);
        // print_r($data["reservations"]);

        $this->view->render('student/counselor/viewBookings', $data);
    }

    public function cancelledReservation($id)
    {
        $this->requireLogin();
        // if (($_SESSION["user_role"] != 5))
        //     $this->redirect();

        $data["reservation_data"] = $this->model('readModel')->getEmptyReservation();
        $data["reservation"] = $data["reservation_data"]["empty"];
        $data["reservation_template"] = $data["reservation_data"]["template"];

        $data["values"] = $this->model('readModel')->getOne("reservation_requests", $id);
        if($data["values"] == null) 
            die(json_encode(["status" => 400, "desc" => "Reservation not found."]));

        $timeslot_id = $data["values"]["timeslot_id"];

        $data["timeslot_data"] = $this->model('readModel')->getEmptyTimeSlot();
        $data["timeslot"] = $data["timeslot_data"]["empty"];
        $data["timeslot_template"] = $data["timeslot_data"]["template"];

        $data["timeslotValues"] = $this->model('readModel')->getOne("timeslots", $timeslot_id);
        if($data["timeslotValues"] == null) 
            die(json_encode(["status" => 400, "desc" => "Time Slot not found."]));

        //status = 0 => created
        //status = 1 => accepted
        //status = 2 => declined
        //status = 3 => accepted and completed
        //status = 4 => accepted and canceled 
        //status = 5 => canceled by the student  
     
        $data["values"]["status"] = 5;

        $result = $this->model('updateModel')->update_one("reservation_requests", $data["values"], $data["reservation_template"], "id", $id, "i");

        $data["timeslotValues"]["status"] = 1;

        $result1 = $this->model('updateModel')->update_one("timeslots", $data["timeslotValues"], $data["timeslot_template"], "id", $timeslot_id, "i");

        if ($result && $result1) {
            die(json_encode(["status" => 200, "desc" => "Reservation Cancelled."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error cancelling Reservation."]));
        } 
    }

    public function filter(){

        $this->requireLogin();
        $data = [
            'title' => 'Event Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        $status = $_POST['status'];
        $counselor_id = $_POST['counselor_id'];
        $student_id = $_SESSION["user_id"];

        if($status == 0){
            $data["reservations"] = $this->model('readModel')->getReservationsByStatus(0,$student_id,$counselor_id);
        }
        else if($status == 1){
            $data["reservations"] = $this->model('readModel')->getReservationsByStatus(1,$student_id,$counselor_id);
        }
        else if($status == 2){
            $data["reservations"] = $this->model('readModel')->getReservationsByStudent($student_id,$counselor_id);
            // print_r($data["reservations"]);
        }
        else if($status == 3){
            $data["reservations"] = $this->model('readModel')->getReservationsByStatus(3,$student_id,$counselor_id);
        }

        // $BASE_URL =  BASE_URL ;

        if(empty($data["reservations"])){
            echo "<div class='font-meidum text-muted'> No reservations found! </div>";
        }
        else{
            foreach ($data["reservations"] as $reservation) { 
                
                        if($reservation["reservation_status"] == 1){
                            $class = "primary";
                            $button = "Accepted";
                        }
                        else if($reservation["reservation_status"] == 3){
                            $class = "orange";
                            $button = "Completed";
                        }
                        else if($reservation["reservation_status"] == 0){
                            $class = "info";
                            $button = "Pending";
                        }
                    
                       echo '<div class=" card-not-added todo_item flex flex-row justify-between border-'. $class.'">
                                <div class="content flex flex-column">
                                    <div class="my-0-5">
                                        <i class="bx bxs-calendar me-1"></i> Date : '. date("Y.m.d", strtotime($reservation["date"])) .'
                                    </div>
                                    
                                    <div class="my-0-5">
                                        <i class="bx bxs-time me-1"></i> Time : '.date("H:i", strtotime($reservation["start_time"])) .' to '. date("H:i", strtotime($reservation["end_time"])) .'
                                    </div>
                                </div>';

                                if($reservation["reservation_status"] == 3){
                                    echo'
                                        <div class="buttons flex flex-column justify-center align-center" style = "width: 30%;">
                                            <div href="#" class=" btn btn-'.$class.' form form-group justify-center align-center text-center" style = "max-width: 120px !important;">'.$button.'</div>
                                        </div>';
                                } 
                                else{ 
                                    echo'
                                        <div class="buttons flex flex-column" style = "width: 30%; margin: 0 !important;">
                                            <div href="#" class=" btn btn-'.$class.' mb-1 form form-group justify-center align-center text-center" style = "max-width: 120px !important;">'.$button.'</div>
                                            <div href="#" class=" btn btn-danger form form-group justify-center align-center text-center button-cancel" style = "max-width: 120px !important;" data-id='.$reservation["reservation_id"].'>Cancel</div>
                                        </div>';
                                }
                        echo '</div>'; 
                    
            }
        }

    }


}
