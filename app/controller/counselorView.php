<?php

class CounselorView extends Controller
{
    public function index($id = 0)
    {
        $this->requireLogin();
        // if ($_SESSION["user_role"] != 1)
        //     $this->redirect();

        $data = [
            'title' => 'Counselor Details',
            'message' => 'Welcome to Aka Hub!'
        ];


        // if (!$data["counselor"])
        //     $this->redirect();
        $data["counselor"] = $this->model('readModel')->getOneCounselor($id);
        $data["posts"] = $this->model('readModel')->getCounselorPosts(1, $id);
        $this->view->render('student/counselor/view', $data);
    }
    public function bookReservation($id = 0)
    {
        $this->requireLogin();

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

            // print_r($data["timeslot"]);
            // print_r($data["student"]);
            // print_r($data["values"]);
            // print_r($data["user_id"]);
            // print_r($result1);
            // die;

            $data["student_details"] = $this->model('readModel')->getOne("student", $data["user_id"]);
            $data["academic_year"] = $data["student_details"]["year"];

            $data["values"] = [
                "student_id" => $data["user_id"],
                "timeslot_id" => $data["timeslot"]["id"],
                "counselor_id" => $data["timeslot"]["counselor_id"],
                "date" => $data["timeslot"]["date"],
                "start_time" => $data["timeslot"]["start_time"],
                "end_time" => $data["timeslot"]["end_time"],
                "status" => 0,
            ];

            //status = 0 => created
            //status = 1 => accepted
            //status = 2 => declined
            //status = 3 => accepted and completed
            //status = 4 => accepted and canceled

            $values = $data["values"];

            $this->validate_template($values, $data["reservation_template"]);
            $result = $this->model('createModel')->insert_db("reservation_requests", $values, $data["reservation_template"]);

            if ($result && $result1){
                $action  = "Reservation created by student";
                $status = "201";
                $this->model("createModel")->createLogEntry($action, $status);
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));
            }
            die(json_encode(array("status" => "400", "desc" => "Error while booking reservation")));
        }



        $data["timeslots"] = $this->model('readModel')->getNotBookedTimeSlotsByCounselorId($id);
        $this->view->render('student/counselor/bookReservation', $data);
    }
}
