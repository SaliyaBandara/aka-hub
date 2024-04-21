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
            'title' => ($action == "create") ? 'Create Timeslot' : 'Edit Timeslot',
            'message' => 'Welcome to Aka Hub!'
        ];
        
        $data["timeSlot_data"] = $this->model('readModel')->getEmptyTimeSlot();
        $data["timeSlot"] = $data["timeSlot_data"]["empty"];
        $data["timeSlot_template"] = $data["timeSlot_data"]["template"];

        if (isset($_POST['addtimeslots'])) {
            $values = $_POST["addtimeslots"];

            $today = new DateTime(); 
            $todayDate = $today->format('Y-m-d');

            if ($values['date'] < $todayDate) {
                die(json_encode(array("status" => "400", "desc" => "Date must be today or later")));
            }

            if ($values['start_time'] >= $values['end_time']) {
                die(json_encode(array("status" => "400", "desc" => "Start time must be before end time")));
            }

            // // Check for overlapping time slots
            // $counselor_id = $_SESSION['counselor_id'];
            // $overlapping_slots = $this->model('readModel')->checkForOverlappingTimeSlots($counselor_id, $values['start_time'], $values['end_time']);

            // if (!empty($overlapping_slots)) {
            //     die(json_encode(array("status" => "400", "desc" => "There are overlapping time slots")));
            // }

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

    public function loadData()
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        $data["timeslots"] = $this->model('readModel')->getAll("timeslots");

        $this->view->render('counselor/manageTimeSlots/addTimeSlots', $data);
    }



    public function delete($id = 0)
    {

        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Please provide a valid time slot id")));

        $result = $this->model('deleteModel')->deleteOne("timeslots", $id);
        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));

        die(json_encode(array("status" => "400", "desc" => "Error while deleting course")));
    }

    public function addToTimeslot($id) {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();
    
        // Update the database column to set added = 1
        $result = $this->model('updateModel')->updateOne("timeslots", $id, ["added" => 1], "id", $id, "i");
        // $result = $this->model('updateModel')->update_one("timeslots", ["added" => 1], [], 'id', $id, 'i');
    
        if ($result) {
            die(json_encode(["status" => 200, "message" => "Time slot successfully added."]));
        } else {
            die(json_encode(["status" => 400, "message" => "Error adding time slot."]));
        }
    }
}