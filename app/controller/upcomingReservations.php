<?php

class upcomingReservations extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'upcomingReservations',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["reservation_requests"] = $this->model('readModel')->getAcceptedReservationRequests("reservation_requests");
        $this->view->render('counselor/upcomingReservations/index', $data);
    }

    public function completedReservation($id)
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

     
        $data["values"]["completed"] = 1;

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

     
        $data["values"]["cancelled"] = 1;

        $result = $this->model('updateModel')->update_one("reservation_requests", $data["values"], $data["reservation_template"], "id", $id, "i");

        if ($result) {
            die(json_encode(["status" => 200, "desc" => "Reservation Cancelled."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error cancelling Reservation."]));
        } 
    }
}
