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

        // $data["reservationRequest_data"] = $this->model('readModel')->getEmptyReservation();
        // $data["reservationRequest"] = $data["reservationRequest_data"]["empty"];
        // $data["reservationRequest_template"] = $data["reservationRequest_data"]["template"];

        $data["reservation_requests"] = $this->model('readModel')->getAll("reservation_requests");
        $this->view->render('counselor/reservationrequests/index', $data);
    }

    public function view($id=0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        $data = [
            'title' => 'Reservation requests',
            'message' => 'Welcome to Aka Hub!'
        ];

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

}
