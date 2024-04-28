<?php

class counselorReservations extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $action = "Unauthorized User tried to access counselor reservations without permission";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'upcomingReservations',
            'message' => 'Welcome to Aka Hub!'
        ];

        $counselor_id = $_SESSION["user_id"];

        $data["reservation_requests"] = $this->model('readModel')->getAcceptedReservationRequests($counselor_id);
        $this->view->render('counselor/Reservations/index', $data);
    }

    public function sendEmail($id=0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();
     
        if ($id != 0) {
            $data["user"] = $this->model('readModel')->getOne("user", $id);
            // if (!$data["user"])
            //     $this->redirect();
        }

        $this->view->render('counselor/Reservations/custom_email_popup', $data); 
    }

    public function completedReservation($id)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $action = "User tried to access reservation details without permission";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'Reservation Details',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["reservation_data"] = $this->model('readModel')->getEmptyReservation();
        $data["reservation"] = $data["reservation_data"]["empty"];
        $data["reservation_template"] = $data["reservation_data"]["template"];

        $data["values"] = $this->model('readModel')->getOne("reservation_requests", $id);
        if($data["values"] == null) 
            die(json_encode(["status" => 400, "desc" => "Reservation not found."]));

        
        //status = 0 => created
        //status = 1 => accepted
        //status = 2 => declined
        //status = 3 => accepted and completed
        //status = 4 => accepted and canceled    
     
        $data["values"]["status"] = 3;

        $result = $this->model('updateModel')->update_one("reservation_requests", $data["values"], $data["reservation_template"], "id", $id, "i");

        if ($result) {
            die(json_encode(["status" => 200, "desc" => "Reservation Completed."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error completing Reservation."]));
        } 
    }

    public function cancelledReservation($id)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        $data["reservation_data"] = $this->model('readModel')->getEmptyReservation();
        $data["reservation"] = $data["reservation_data"]["empty"];
        $data["reservation_template"] = $data["reservation_data"]["template"];

        $data["values"] = $this->model('readModel')->getOne("reservation_requests", $id);
        if($data["values"] == null) 
            die(json_encode(["status" => 400, "desc" => "Reservation not found."]));

        //status = 0 => created
        //status = 1 => accepted
        //status = 2 => declined
        //status = 3 => accepted and completed
        //status = 4 => accepted and canceled   
        //status = 5 => canceled by student
     
        $data["values"]["status"] = 4;

        $result = $this->model('updateModel')->update_one("reservation_requests", $data["values"], $data["reservation_template"], "id", $id, "i");
        if ($result) {
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
        $counselor_id = $_SESSION["user_id"];

        if($status == 1){
            $data["reservation_requests"] = $this->model('readModel')->getReservationRequestsByStatus(1,$counselor_id);
        }
        else if($status == 3){
            $data["reservation_requests"] = $this->model('readModel')->getReservationRequestsByStatus(3,$counselor_id);
        }
        else if($status == 4){
            $data["reservation_requests"] = $this->model('readModel')->getReservationRequestsByStatus(4,$counselor_id);
            // print_r($data["reservations"]);
        }
        else if($status == 5){
            $data["reservation_requests"] = $this->model('readModel')->getReservationRequestsByStatus(5,$counselor_id);
        }

        // print_r($data["reservation_requests"]);
        // die;
        // $BASE_URL =  BASE_URL ;

        if(empty($data["reservation_requests"])){
            echo "<div class='font-meidum text-muted'> No reservations found! </div>";
        }
        else{
            foreach ($data["reservation_requests"] as $reservation) {    
                        
                $img_src = USER_IMG_PATH . $reservation["profile_img"]; 
                $class1 = 'bx bxs-user-check';
                $class2 = "bx bxs-user-x";

                       echo '<div class="card-content">
                                <div class="card">
                                    <div class="image-content">
                                        <span class="overlay1"></span>

                                        <div class="card-image">
                                            <img src="'. $img_src.'" alt="" class="card-img">
                                        </div>
                                    </div>';

                                    if($reservation["status"] == 3){
                                        echo'
                                        <div class="card-content">
                                        <h2 class="name">'. $reservation["name"].'</h2>
                                        <label class="description">Date: '. date("Y.m.d", strtotime($reservation["date"])) .'</label>
                                        <label class="description">Time Slot: '.date("H:i", strtotime($reservation["start_time"])) .' to '. date("H:i", strtotime($reservation["end_time"])) .'</label>
                                        <label class="description">Email: '. $reservation["email"].' </label>
                                        <button class="button button-completed">Completed</button>
                                    </div>
                                </div>';
                                    } 
                                    else if($reservation["status"] == 4){ 
                                        echo'
                                        <div class="card-content">
                                        <h2 class="name">'. $reservation["name"].'</h2>
                                        <label class="description">Date: '. date("Y.m.d", strtotime($reservation["date"])) .'</label>
                                        <label class="description">Time Slot: '.date("H:i", strtotime($reservation["start_time"])) .' to '. date("H:i", strtotime($reservation["end_time"])) .'</label>
                                        <label class="description">Email: '. $reservation["email"].' </label>
                                        <button class="button button-cancelled" data-id='. $reservation["id"].'>Cancelled </i></button>
                                    </div>
                                </div>';
                                    }
                                    else if($reservation["status"] == 5){ 
                                        echo'
                                        <div class="card-content">
                                        <h2 class="name">'. $reservation["name"].'</h2>
                                        <label class="description">Date: '. date("Y.m.d", strtotime($reservation["date"])) .'</label>
                                        <label class="description">Time Slot: '.date("H:i", strtotime($reservation["start_time"])) .' to '. date("H:i", strtotime($reservation["end_time"])) .'</label>
                                        <label class="description">Email: '. $reservation["email"].' </label>
                                        <button class="button button-cancelled" data-id='. $reservation["id"].'>Cancelled </i></button>
                                    </div>
                                </div>';
                                    }
                                    else{ 
                                        echo'
                                        <div class="card-content">
                                        <h2 class="name">'. $reservation["name"].'</h2>
                                        <label class="description">Date: '. date("Y.m.d", strtotime($reservation["date"])) .'</label>
                                        <label class="description">Time Slot: '.date("H:i", strtotime($reservation["start_time"])) .' to '. date("H:i", strtotime($reservation["end_time"])) .'</label>
                                        <label class="description">Email: '. $reservation["email"].' </label>
                                        <button class="button button-complete" data-id='. $reservation["id"].'>Complete <i class="bx bxs-user-check"></i></button>
                                        <button class="button button-cancel" data-id='. $reservation["id"].'>Cancel <i class="bx bxs-user-x"></i></button>
                                    </div>
                                </div>';
                                    }
                        echo '</div>';     
                    
            }
        }

    }

}
