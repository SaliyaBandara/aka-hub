<?php

class counselorReservationRequests extends Controller
{

    public function index()
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        $data = [
            'title' => 'Reservation requests',
            'message' => 'Welcome to Aka Hub!'
        ];

        $user_id = $_SESSION["user_id"];
        $data["reservation_requests"] = $this->model('readModel')->getAvailableReservationRequestsByCounselorId($user_id);
        $this->view->render('counselor/reservationRequests/index', $data);
    }

    public function view($id=0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        $data["reservationRequest_data"] = $this->model('readModel')->getEmptyReservation();
        $data["reservationRequest"] = $data["reservationRequest_data"]["empty"];
        $data["reservationRequest_template"] = $data["reservationRequest_data"]["template"];

        $counselor_id = $_SESSION["user_id"];
     
        if ($id != 0) {
            $data["reservationRequest"] = $this->model('readModel')->getOneReservationRequest($counselor_id, $id);
            if (!$data["reservationRequest"])
                $this->redirect();
        }

        $this->view->render('counselor/reservationRequests/popup', $data); 
    }

    public function acceptReservation($id=0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        $data["reservation_data"] = $this->model('readModel')->getEmptyReservation();
        $data["reservation"] = $data["reservation_data"]["empty"];
        $data["reservation_template"] = $data["reservation_data"]["template"];

        $data["values"] = $this->model('readModel')->getOne("reservation_requests", $id);
        if($data["values"] == null) 
            die(json_encode(["status" => 400, "desc" => "Time slot not found."]));

        // print_r($data["values"]);
        // die;

        //status = 0 => created
        //status = 1 => accepted
        //status = 2 => declined
        //status = 3 => accepted and completed
        //status = 4 => accepted and canceled

        $data["values"]["status"] = 1;

        $result = $this->model('updateModel')->update_one("reservation_requests", $data["values"], $data["reservation_template"], "id", $id, "i");

        // print_r($data["values"]);
        // die;

        if ($result) {
            die(json_encode(["status" => 200, "desc" => "Reservation Accepted."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error accepting Reservation."]));
        } 
    }

    public function declineReservation($id=0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        $data["reservation_data"] = $this->model('readModel')->getEmptyReservation();
        $data["reservation"] = $data["reservation_data"]["empty"];
        $data["reservation_template"] = $data["reservation_data"]["template"];

        $data["values"] = $this->model('readModel')->getOne("reservation_requests", $id);
        if($data["values"] == null) 
            die(json_encode(["status" => 400, "desc" => "Time slot not found."]));

        // print_r($data["values"]);
        // die;

        //status = 0 => created
        //status = 1 => accepted
        //status = 2 => declined
        //status = 3 => accepted and completed
        //status = 4 => accepted and canceled

        $data["values"]["status"] = 2;

        $result = $this->model('updateModel')->update_one("reservation_requests", $data["values"], $data["reservation_template"], "id", $id, "i");

        // print_r($data["values"]);
        // die;

        if ($result) {
            die(json_encode(["status" => 200, "desc" => "Reservation Declined."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error Declining Reservation."]));
        } 
    }

}
