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

        $this->view->render('counselor/upcomingReservations/index', $data);
    }
}
