<?php

class ReservationRequests extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Reservation requestss',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/reservationrequests/index', $data);
    }
}