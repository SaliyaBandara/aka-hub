<?php

class ManageTimeSlots extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Manage Time Slots',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/manageTimeSlots/index', $data);
    }
    public function addtimeslots()
    {
        $data = [
            'title' => 'Manage Time Slots',
            'message' => 'Welcome to Aka Hub!'
        ];
        
        $data["timeslots"] = $this->model('readModel')->getAll("timeslots");
        // $this->view->render('counselor/reservationrequests/index', $data);
        $this->view->render('counselor/manageTimeSlots/addTimeSlots', $data);
    }
}