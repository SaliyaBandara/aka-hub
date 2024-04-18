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
    public function addtimeslots($id = 0, $action = "create")
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        $data = [
            'title' => 'Manage Time Slots',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data = [
            'title' => ($action == "create") ? 'Create Timeslot' : 'Edit Timeslot',
            'message' => 'Welcome to Aka Hub!'
        ];
        
        $data["timeSlot_data"] = $this->model('readModel')->getEmptyTimeSlot();
        $data["timeSlot"] = $data["timeSlot_data"]["empty"];
        $data["timeSlot_template"] = $data["timeSlot_data"]["template"];

        if (isset($_POST['addtimeslots'])) {
            $values = $_POST["addtimeslots"];
            $this->validate_template($values, $data["timeSlot_template"]);

            if ($id == 0)
                $result = $this->model('createModel')->insert_db("timeslots", $values, $data["timeSlot_template"]);

            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Error while " . $action . "ing timeSlot")));
        }

        $data["id"] = $id;
        $data["action"] = $action;

        if ($id != 0) {
            $data["timeSlot"] = $this->model('readModel')->getOne("timeslots", $id);
            if (!$data["timeSlot"])
                $this->redirect();
        }

        // print params
        // print_r($id);
        // print_r($action);

        $data["timeslots"] = $this->model('readModel')->getAll("timeslots");

        $this->view->render('counselor/manageTimeSlots/addTimeSlots', $data);
    }
    
//     public function add_time_slot($id = 0, $action = "create")
//     {
//         $this->requireLogin();
//         if (($_SESSION["user_role"] != 5))
//             $this->redirect();

//         $data = [
//             'title' => ($action == "create") ? 'Create Timeslot' : 'Edit Timeslot',
//             'message' => 'Welcome to Aka Hub!'
//         ];

//         $data["timeSlot_data"] = $this->model('readModel')->getEmptyTimeSlot();
//         $data["timeSlot"] = $data["timeSlot_data"]["empty"];
//         $data["timeSlot_template"] = $data["timeSlot_data"]["template"];

//         if (isset($_POST['add_time_slot'])) {
//             $values = $_POST["add_time_slot"];
//             $this->validate_template($values, $data["timeSlot_template"]);

//             if ($id == 0)
//                 $result = $this->model('createModel')->insert_db("timeslots", $values, $data["timeSlot_template"]);

//             if ($result)
//                 die(json_encode(array("status" => "200", "desc" => "Operation successful")));

//             die(json_encode(array("status" => "400", "desc" => "Error while " . $action . "ing timeSlot")));
//         }

//         $data["id"] = $id;
//         $data["action"] = $action;

//         if ($id != 0) {
//             $data["timeSlot"] = $this->model('readModel')->getOne("timeslots", $id);
//             if (!$data["timeSlot"])
//                 $this->redirect();
//         }

//         // print params
//         // print_r($id);
//         // print_r($action);

//         $data["timeslots"] = $this->model('readModel')->getAll("timeslots");

//         $this->view->render('counselor/manageTimeSlots/addTimeSlots', $data);
//     }
}