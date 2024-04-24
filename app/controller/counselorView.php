<?php

class CounselorView extends Controller
{
    public function index($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 0)
            $this->redirect();

        $data = [
            'title' => 'Counselor Details',
            'message' => 'Welcome to Aka Hub!'
        ];


        $data["counselor"] = $this->model('readModel')->getOneCounselor($id);
        $data["posts"] = $this->model('readModel')->getCounselorPosts(1, $id);
        $this->view->render('student/counselor/view', $data);
    }

    public function bookReservation($id = 0)

    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 0)
            $this->redirect();

        $data = [
            'title' => 'Counselor Details',
            'message' => 'Welcome to Aka Hub!'
        ];    

        $data["reservation_data"] = $this->model('readModel')->getEmptyReservation();
        $data["reservation"] = $data["reservation_data"]["empty"];
        $data["reservation_template"] = $data["reservation_data"]["template"];


        if (isset($_POST['timeslot_id'])) {

            $data["user_id"] = $_SESSION["user_id"];
            $data["student"] = $this->model('readModel')->getOne("user", $data["user_id"]);
            $data["timeslot"] = $this->model('readModel')->getOne("timeslots", $id);

            if($data["timeslot"] == null || $data["student"] == null)
                die(json_encode(array("status" => "400", "desc" => "Invalid request")));

            $data["timeSlot_data"] = $this->model('readModel')->getEmptyTimeSlot();
            $data["timeSlot"] = $data["timeSlot_data"]["empty"];
            $data["timeSlot_template"] = $data["timeSlot_data"]["template"];

            $data["values"] = $this->model('readModel')->getOne("timeslots", $id);
            if($data["values"] == null) 
                die(json_encode(["status" => 400, "desc" => "Time slot not found."]));

            $data["values"]["status"] = 3;    

            $result1 = $this->model('updateModel')->update_one("timeslots", $data["values"], $data["timeSlot_template"], "id", $id, "i");
          
            $data["reservation"]["timeslot_id"] = $id; 
            $data["reservation"]["student_id"] = $_SESSION["user_id"];

            //status = 0 => created
            //status = 1 => accepted
            //status = 2 => declined
            //status = 3 => accepted and completed
            //status = 4 => accepted and canceled

            $isValidated = $this->validate_template( $data["reservation"], $data["reservation_template"]);
            // print_r($isValidated);
            $result = $this->model('createModel')->insert_db("reservation_requests",  $data["reservation"] , $data["reservation_template"]);

            if ($result && $result1){
                $action  = "Reservation created by student";
                $status = "201";
                $this->model("createModel")->createLogEntry($action, $status);
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));
            }
            die(json_encode(array("status" => "400", "desc" => "Error while booking reservation")));
        }


        $data["timeslots"] = $this->model('readModel')->getNotBookedTimeSlotsByCounselorId($id);
        $data["counselor"] = $this->model('readModel')->getOneCounselor($id);

        $data["latestReservation"] = $this->model('readModel')->getLatestReservation($_SESSION["user_id"], $id);

        // print_r($data["latestReservation"]);

        $this->view->render('student/counselor/bookReservation', $data);
    }

    public function checkExistingReservations()
    {
        $this->requireLogin();

        $data = [
            'title' => 'Counselor Details',
            'message' => 'Welcome to Aka Hub!'
        ];

        $user_id = $_SESSION["user_id"]; 
        
        // print_r($user_id);
        // die;
    
        $result = $this->model('readModel')->checkExistingReservations($user_id);

        // print_r($data["reservation"]);
        // die;

        if ($result) {
            die(json_encode(["status" => 200, "desc" => "There are existing reservations. Cannot make a new reservation."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "There are no existing reservations."]));
        }
    }

}
