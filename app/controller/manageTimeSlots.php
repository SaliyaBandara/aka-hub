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
}