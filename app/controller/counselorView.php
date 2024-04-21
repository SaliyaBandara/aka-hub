<?php

class CounselorView extends Controller
{
    public function index($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1)
            $this->redirect();

        $data = [
            'title' => 'Counselor Details',
            'message' => 'Welcome to Aka Hub!'
        ];


        
        // if (!$data["counselor"])
        //     $this->redirect();
        $data["counselor"] = $this->model('readModel')->getOneCounselor($id);
        $data["posts"] = $this->model('readModel')->getCounselorPosts(1,$id);
        $this->view->render('student/counselor/view', $data);
    }
    public function bookReservation($id = 0)
    {
        $this->requireLogin();

        $data = [
            'title' => 'Counselor Details',
            'message' => 'Welcome to Aka Hub!'
        ];


        
        // if (!$data["counselor"])
        //     $this->redirect();
        $data["timeslots"] = $this->model('readModel')->getAddedTimeSlots("timeslots");
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