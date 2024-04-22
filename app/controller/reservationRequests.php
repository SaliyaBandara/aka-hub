<?php

class ReservationRequests extends Controller
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


        $data["reservation_requests"] = $this->model('readModel')->getAvailableReservationRequests("reservation_requests");
        $this->view->render('counselor/reservationrequests/index', $data);
    }

    public function view($id=0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        // $data = [
        //     'title' => 'Reservation requests',
        //     'message' => 'Welcome to Aka Hub!'
        // ];

        $data["reservationRequest_data"] = $this->model('readModel')->getEmptyReservation();
        $data["reservationRequest"] = $data["reservationRequest_data"]["empty"];
        $data["reservationRequest_template"] = $data["reservationRequest_data"]["template"];

        $data["id"] = $id;

        if ($id != 0) {
            $data["reservationRequest"] = $this->model('readModel')->getOne("reservation_requests", $id);
            if (!$data["reservationRequest"])
                $this->redirect();
        }

        $data["reservation_requests"] = $this->model('readModel')->getAll("reservation_requests");
        $this->view->render('counselor/reservationrequests/popup', $data); 
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

        
        $data["values"]["accepted"] = 1;

        $result = $this->model('updateModel')->update_one("reservation_requests", $data["values"], $data["reservation_template"], "id", $id, "i");

        // print_r($data["values"]);
        // die;

        if ($result) {
            die(json_encode(["status" => 200, "desc" => "Time slot successfully Added."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error adding time slot."]));
        } 
    }

}
