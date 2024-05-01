<?php

class CounselorPanel extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $action = "Unauthorized User tried to access counselor panel without permission";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'CounselorPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["count_accepted_reservations"] = $this->model('readModel')->getCountAcceptedReservations();
        $data["count_free_timeslots"] = $this->model('readModel')->getCountFreeTimeSlots();
        $data["count_requests"] = $this->model('readModel')->getCountReservationRequests();
        $data["chartOne"] = $this->model('readModel')->getChartOne();;
        $data["chartFive"] = $this->model('readModel')->getChartFive();


        $this->view->render('counselor/counselorpanel/index', $data);
    }
}
