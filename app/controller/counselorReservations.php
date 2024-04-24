<?php

class counselorReservations extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $action = "User tried to access counselor reservations without permission";
            $status = "400";
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

    public function completedReservation($id)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $action = "User tried to access reservation details without permission";
            $status = "400";
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
     
        $data["values"]["status"] = 4;

        $result = $this->model('updateModel')->update_one("reservation_requests", $data["values"], $data["reservation_template"], "id", $id, "i");
        if ($result) {
            die(json_encode(["status" => 200, "desc" => "Reservation Cancelled."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error cancelling Reservation."]));
        } 
    }
}
