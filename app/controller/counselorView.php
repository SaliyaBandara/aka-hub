<?php

class CounselorView extends Controller
{
    public function index($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 0){
            $action = "Unauthorized User tried to access counselor view without permission";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
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
                                            <div href="#" class=" btn btn-danger form form-group justify-center align-center text-center" style = "max-width: 120px !important;">Cancel</div>
                                        </div>';
                                }
                        echo '</div>'; 
                    
            }
        }

    }


}
