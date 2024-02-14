<?php

class ReservationRequests extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Reservation requests',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["reservation_requests"] = $this->model('readModel')->getAll("reservation_requests");
        $this->view->render('counselor/reservationrequests/index', $data);
    }

    public function viewrequest()
    {
        $data = [
            'title' => 'View Requests',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/reservationrequests/viewRequests', $data);
    }
}