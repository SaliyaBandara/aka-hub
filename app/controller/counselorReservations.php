<?php

class CounselorReservations extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'CounselorReservations',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/counselorReservations/index', $data);
    }
}