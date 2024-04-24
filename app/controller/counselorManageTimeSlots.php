<?php

class counselorManageTimeSlots extends Controller
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

            $values["counselor_id"] = $_SESSION["user_id"];

            // print_r($values);
            // die;

            $today = new DateTime(); 
            $todayDate = $today->format('Y-m-d');

            if ($values['date'] < $todayDate) {
                die(json_encode(array("status" => "400", "desc" => "Date must be today or later")));
            }

            if ($values['start_time'] >= $values['end_time']) {
                die(json_encode(array("status" => "400", "desc" => "Start time must be before end time")));
            }

            // Check for overlapping time slots
            $counselor_id = $_SESSION['user_id'];
            $overlapping_slots = $this->model('readModel')->checkForOverlappingTimeSlots($counselor_id, $values['start_time'], $values['end_time'], $values['date']);

            if (!empty($overlapping_slots)) {
                die(json_encode(array("status" => "400", "desc" => "There are overlapping time slots")));
            }

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
        $user_id = $_SESSION["user_id"];    

        $data["timeslots"] = $this->model('readModel')->getTimeSlotsByCounselorId($user_id);

        // $data["timeslots"] = $this->model('readModel')->getAddedTimeSlots("timeslots");

        $this->view->render('counselor/manageTimeSlots/addTimeSlots', $data);
    }

    public function loadData()
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        $user_id = $_SESSION["user_id"];    

        $data["timeslots"] = $this->model('readModel')->getTimeSlotsByCounselorId($user_id); 

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

    public function addToTimeslot($id ) {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        $data["timeSlot_data"] = $this->model('readModel')->getEmptyTimeSlot();
        $data["timeSlot"] = $data["timeSlot_data"]["empty"];
        $data["timeSlot_template"] = $data["timeSlot_data"]["template"];

        $data["values"] = $this->model('readModel')->getOne("timeslots", $id);
        if($data["values"] == null) 
            die(json_encode(["status" => 400, "desc" => "Time slot not found."]));
        
        

        //status = 0 => created
        //status = 1 => added
        //status = 2 => removed
        //status = 3 => booked

        $data["values"]["status"] = 1;
        // $data["values"]["counselor_id"] = $_SESSION["user_id"];

        $result = $this->model('updateModel')->update_one("timeslots", $data["values"], $data["timeSlot_template"], "id", $id, "i");

        if ($result) {
            die(json_encode(["status" => 200, "desc" => "Time slot successfully Added."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error adding time slot."]));
        }
    }

    public function removeTimeslot($id) {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        $data["timeSlot_data"] = $this->model('readModel')->getEmptyTimeSlot();
        $data["timeSlot"] = $data["timeSlot_data"]["empty"];
        $data["timeSlot_template"] = $data["timeSlot_data"]["template"];

        $data["values"] = $this->model('readModel')->getOne("timeslots", $id);
        if($data["values"] == null) 
            die(json_encode(["status" => 400, "desc" => "Time slot not found."]));
        // print_r($data["values"]);
        // die;
        

        //status = 0 => created
        //status = 1 => added
        //status = 2 => removed
        //status = 3 => booked

        $data["values"]["status"] = 2;

        // print_r($data["values"]);
        // die;

        $result = $this->model('updateModel')->update_one("timeslots", $data["values"], $data["timeSlot_template"], "id", $id, "i");

        if ($result) {
            die(json_encode(["status" => 200, "desc" => "Time slot successfully Removed."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error removing time slot."]));
        }
    }
}