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
        if (($_SESSION["user_role"] != 5)){
            $task="Unauthorized user tried to access addtimeslots page for counselor.";
            $this->model("createModel")->createLogEntry($task, "401");
            $this->redirect();
          
        $data["timeSlot_data"] = $this->model('readModel')->getEmptyTimeSlot();
        $data["timeSlot"] = $data["timeSlot_data"]["empty"];
        $data["timeSlot_template"] = $data["timeSlot_data"]["template"];

        if (isset($_POST['addtimeslots'])) {
            $values = $_POST["addtimeslots"];

            $values["counselor_id"] = $_SESSION["user_id"];

            // print_r($values);
            // die;

            $today = new DateTime();
            // $todayDate = $today->format('Y-m-d');
            $today = $today->format('Y-m-d H:i:s');
            $date_time = $values['date'] . " " . $values['start_time'];

            if ($date_time < $today) {
                die(json_encode(array("status" => "400", "desc" => "Please select a upcoming date and time")));
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

            if ($result){
                $task = "Counselor added a new time slot.";
                $this->model("createModel")->createLogEntry($task, "201");
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));
            }
            die(json_encode(array("status" => "400", "desc" => "Error while " . $action . "ing timeSlot")));
        }
    }

    public function loadData()
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5)){
            $task="Unauthorized user tried to access loadData function for counselor.";
            $this->model("createModel")->createLogEntry($task, "401");
            $this->redirect();
        }
        $user_id = $_SESSION["user_id"];    

        $data["timeslots"] = $this->model('readModel')->getTimeSlotsByCounselorId($user_id); 

        $this->view->render('counselor/manageTimeSlots/addTimeSlots', $data);
    }



    public function delete($id = 0)
    {

        $this->requireLogin();
        if (($_SESSION["user_role"] != 5)){
            $task="Unauthorized user tried to access delete function for counselor.";
            $this->model("createModel")->createLogEntry($task, "401");
            $this->redirect();
        }
        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Please provide a valid time slot id")));

        $result = $this->model('deleteModel')->deleteOne("timeslots", $id);
        if ($result){
            $task = "Counselor deleted a time slot.";
            $this->model("createModel")->createLogEntry($task, "200");
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));
        }
        die(json_encode(array("status" => "400", "desc" => "Error while deleting course")));
    }

    public function addToTimeslot($id)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5)){
            $task="Unauthorized user tried to access addToTimeslot function for counselor.";
            $this->model("createModel")->createLogEntry($task, "401");
            $this->redirect();
        }
        $data["timeSlot_data"] = $this->model('readModel')->getEmptyTimeSlot();
        $data["timeSlot"] = $data["timeSlot_data"]["empty"];
        $data["timeSlot_template"] = $data["timeSlot_data"]["template"];

        $data["values"] = $this->model('readModel')->getOne("timeslots", $id);
        if ($data["values"] == null)
            die(json_encode(["status" => 400, "desc" => "Time slot not found."]));



        //status = 0 => created
        //status = 1 => added
        //status = 2 => removed
        //status = 3 => booked

        $data["values"]["status"] = 1;
        // $data["values"]["counselor_id"] = $_SESSION["user_id"];

        $result = $this->model('updateModel')->update_one("timeslots", $data["values"], $data["timeSlot_template"], "id", $id, "i");

        if ($result) {
            $task = "Counselor added a time slot.";
            $this->model("createModel")->createLogEntry($task, "200");
            die(json_encode(["status" => 200, "desc" => "Time slot successfully Added."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error adding time slot."]));
        }
    }

    public function removeTimeslot($id)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5)){
            $task="Unauthorized user tried to access removeTimeslot function for counselor.";
            $this->model("createModel")->createLogEntry($task, "401");
            $this->redirect();
        }
        $data["timeSlot_data"] = $this->model('readModel')->getEmptyTimeSlot();
        $data["timeSlot"] = $data["timeSlot_data"]["empty"];
        $data["timeSlot_template"] = $data["timeSlot_data"]["template"];

        $data["values"] = $this->model('readModel')->getOne("timeslots", $id);
        if ($data["values"] == null)
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
            $task = "Counselor removed a time slot.";
            $this->model("createModel")->createLogEntry($task, "200");
            die(json_encode(["status" => 200, "desc" => "Time slot successfully Removed."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error removing time slot."]));
        }
    }

    public function filterDates($start_date = null, $end_date = null)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            die(json_encode(["status" => 403, "desc" => "Access Forbidden."]));
        }

        $data = [
            'title' => 'Manage Time Slots',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["timeSlot_data"] = $this->model('readModel')->getEmptyTimeSlot();
        $data["timeSlot"] = $data["timeSlot_data"]["empty"];
        $data["timeSlot_template"] = $data["timeSlot_data"]["template"];

        // print_r($start_date);
        // print_r($end_date);
        // print_r($_SESSION["user_id"]);
        // die;

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $user_id = $_SESSION["user_id"];

        $data["timeslots"] = $this->model('readModel')->getAllTimeSlotsByDateRange($user_id, $start_date, $end_date);

        $this->view->render('counselor/manageTimeSlots/addTimeSlots', $data);
    }
}
