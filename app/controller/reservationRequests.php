<?php

class ReservationRequests extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Reservation requestss',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/reservationrequests/index', $data);
    }
}