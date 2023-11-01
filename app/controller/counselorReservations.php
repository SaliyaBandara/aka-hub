<?php

class CounselorReservations extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'CounselorReservations',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/counselorReservations/index', $data);
    }

    public function reservationdetails()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Reservation Details',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/counselorReservations/reservationDetails', $data);
    }
}