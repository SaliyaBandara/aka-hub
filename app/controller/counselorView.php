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



        // $_SESSION["user_id"]


        // $empty = [
        //     "id" => "",
        //     "timeslot_id" => "",
        //     "student_id" => "",
        //     "year" => "",
        //     "date" => "",
        //     "start_time" => "",
        //     "end_time" => "",
        //     "accepted" => "",
        //     "declined" => "",
        // ];



        if (isset($_POST['timeslot_id'])) {
            $data["user_id"] = $_SESSION["user_id"];
            $data["student"] = $this->model('readModel')->getOne("user", $data["user_id"]);
            $data["timeslot"] = $this->model('readModel')->getOne("timeslots", $id);

            if($data["timeslot"] == null || $data["student"] == null)
                die(json_encode(array("status" => "400", "desc" => "Invalid request")));

            // print_r($data["timeslot"]);
            // print_r($data["student"]);
            // print_r($data["user_id"]);
            // die;

            $data["values"] = [
                "student_id" => $data["user_id"],
                "timeslot_id" => $data["timeslot"]["id"],
                "year" => "2",
                "date" => $data["timeslot"]["date"],
                "start_time" => $data["timeslot"]["start_time"],
                "end_time" => $data["timeslot"]["end_time"],
                "accepted" => 0,
                "declined" => 0,
            ];

            $values = $data["values"];

            $this->validate_template($values, $data["reservation_template"]);
            $result = $this->model('createModel')->insert_db("reservation_requests", $values, $data["reservation_template"]);

            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Error while booking reservation")));
        }



        // if (!$data["counselor"])
        //     $this->redirect();
        $data["timeslots"] = $this->model('readModel')->getNotBookedTimeSlots("timeslots");
        // $data["posts"] = $this->model('readModel')->getCounselorPosts($id);
        $this->view->render('student/counselor/bookReservation', $data);
    }

    public function updateTimeSlots($id = 0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 0))
            $this->redirect();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["timeslot_id"])) {
            $timeslotId = $_POST["timeslot_id"];

            $result = $this->model('updateModel')->update_one("timeslots", ["booked" => 1], [], "id", $timeslotId, "i");

            if ($result) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to book timeslot."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid request."]);
        }
    }
}
