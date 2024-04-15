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
        $this->view->render('counselor/manageTimeSlots/addTimeSlots', $data);
    }
    
    public function createTimeSlot()
    {
        // Assuming you're using some form of dependency injection or service container
        $createModel = new createModel();

        // Get the start time and end time from the form submission
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

        // Create an array with the data to be inserted
        $data = [
            'start_time' => $start_time,
            'end_time' => $end_time,
            // Add more fields if needed
        ];

        // Specify the template for validation if needed
        $template = [
            'start_time' => ['type' => 'string'], // Assuming start_time and end_time are strings
            'end_time' => ['type' => 'string'],
            // Add more fields if needed
        ];

        // Call the insert_db method from your createModel class
        $createModel->insert_db('timeslots', $data, $template);

        // Redirect or do something else after insertion
    }
}