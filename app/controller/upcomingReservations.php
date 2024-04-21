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
}
