<?php

class CounselorReservations extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $action = "User tried to access counselor reservations without permission";
            $status = "400";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'CounselorReservations',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/counselorReservations/index', $data);
    }

    public function reservationdetails()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $action = "User tried to access reservation details without permission";
            $status = "400";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'Reservation Details',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/counselorReservations/reservationDetails', $data);
    }
}