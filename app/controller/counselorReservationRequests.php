<?php

class counselorReservationRequests extends Controller
{

    public function index()
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5)) {
            $task = "Unauthorized user tried to access reservation requests page for counselor.";
            $this->model("createModel")->createLogEntry($task, "401");
            $this->redirect();
        }
        $data = [
            'title' => 'Reservation requests',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["count_accepted_reservations"] = $this->model('readModel')->getCountAcceptedReservations();
        $data["count_free_timeslots"] = $this->model('readModel')->getCountFreeTimeSlots();
        $data["count_requests"] = $this->model('readModel')->getCountReservationRequests();

        $user_id = $_SESSION["user_id"];
        $data["reservation_requests"] = $this->model('readModel')->getAvailableReservationRequestsByCounselorId($user_id);
        $this->view->render('counselor/reservationRequests/index', $data);
    }

    public function view($id = 0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5)) {
            $task = "Unauthorized user tried to access view reservation request page for counselor.";
            $this->model("createModel")->createLogEntry($task, "401");
            $this->redirect();
        }

        $data["reservationRequest_data"] = $this->model('readModel')->getEmptyReservation();
        $data["reservationRequest"] = $data["reservationRequest_data"]["empty"];
        $data["reservationRequest_template"] = $data["reservationRequest_data"]["template"];

        $counselor_id = $_SESSION["user_id"];

        if ($id != 0) {
            $data["reservationRequest"] = $this->model('readModel')->getOneReservationRequest($counselor_id, $id);
            if (!$data["reservationRequest"])
                $this->redirect();
        }

        $this->view->render('counselor/reservationRequests/accept_decline_popup', $data);
    }

    public function emailPopup($id = 0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5)) {
            $task = "Unauthorized user tried to access send email function for counselor.";
            $this->model("createModel")->createLogEntry($task, "401");
            $this->redirect();
        }

        // print_r($id);
        // die();

        $counselor_id = $_SESSION["user_id"];

        if ($id != 0) {
            $data["reservationRequest"] = $this->model('readModel')->getOneReservationRequest($counselor_id, $id);
            $student_id = $this->model('readModel')->getStudentIdByReservation($id);
            $data["user"] = $this->model('readModel')->getOne("user", $student_id);
            if (!$data["user"])
                $this->redirect();
        }
        // print_r($data["reservationRequest"]);
        // die();

        

        $this->view->render('counselor/reservationRequests/custom_email_popup', $data);
    }

    public function sendEmail()
    {
        $message = $_POST["message"];
        $reservation_id = $_POST["id"];

        if ($message != "") {
            die(json_encode(["status" => 200, "desc" => "Email Sent"]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error Declining Reservation."]));
        }
    
        $counselor_id = $_SESSION["user_id"];
        
        $data["reservationRequest"] = $this->model('readModel')->getOneReservationRequest($counselor_id, $reservation_id); 
        $user_id = $data["reservationRequest"]["student_id"];
        // print_r($_POST['id']);
        // print_r($message);
        // die;

        $full_message = "Unfortunately your counselor is not available for your reservation request. Please book another timeslot.<br/><br/>";
        $full_message = $full_message . $message;
        $link = "/counselorView/bookReservation/$counselor_id";
        $this->model('createModel')->notification(7, $counselor_id, $user_id, "Counsellor Unavailable for Reservation", $message, 0, $link);
    }

    public function acceptReservation($id = 0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5)) {
            $task = "Unauthorized user tried to access accept reservation function for counselor.";
            $this->model("createModel")->createLogEntry($task, "401");
            $this->redirect();
        }

        $data["reservation_data"] = $this->model('readModel')->getEmptyReservation();
        $data["reservation"] = $data["reservation_data"]["empty"];
        $data["reservation_template"] = $data["reservation_data"]["template"];

        $data["values"] = $this->model('readModel')->getOne("reservation_requests", $id);
        if ($data["values"] == null)
            die(json_encode(["status" => 400, "desc" => "Time slot not found."]));

        // print_r($data["values"]);
        // die;

        //status = 0 => created
        //status = 1 => accepted
        //status = 2 => declined
        //status = 3 => accepted and completed
        //status = 4 => accepted and canceled

        $data["values"]["status"] = 1;

        $result = $this->model('updateModel')->update_one("reservation_requests", $data["values"], $data["reservation_template"], "id", $id, "i");

        // print_r($data["values"]);
        // die;

        if ($result) {
            $task = "Counselor accepted a reservation.";
            $this->model("createModel")->createLogEntry($task, "200");

            // get the counselor id
            $counselor_id = $_SESSION["user_id"];
            $user_id = $data["values"]["student_id"];
            $timeslot_id = $data["values"]["timeslot_id"];
            $timeslot = $this->model('readModel')->getOne("timeslots", $timeslot_id);

            // format Wednesday, 10th March 2021, 10:00 AM
            $slot_date = date("l, jS F Y", strtotime($timeslot["date"]));
            $slot_start_time = date("h:i A", strtotime($timeslot["start_time"]));
            $date_time = $slot_date . ", " . $slot_start_time;

            $message = "Your counselor has accepted your reservation request for the date and time: $date_time. Make sure to be present at the specified time.";
            $link = "/counselorView/viewBookings/$counselor_id";

            // notification($type, $id, $user_id, $title, $message, $target = 0, $link = "")
            $this->model('createModel')->notification(6, $counselor_id, $user_id, "Counsellor Reservation Accepted", $message, 0, $link);
            die(json_encode(["status" => 200, "desc" => "Reservation Accepted."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error accepting Reservation."]));
        }
    }

    public function declineReservation($id = 0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5)) {
            $task = "Unauthorized user tried to access decline reservation function for counselor.";
            $this->model("createModel")->createLogEntry($task, "401");
            $this->redirect();
        }

        $data["reservation_data"] = $this->model('readModel')->getEmptyReservation();
        $data["reservation"] = $data["reservation_data"]["empty"];
        $data["reservation_template"] = $data["reservation_data"]["template"];

        $data["values"] = $this->model('readModel')->getOne("reservation_requests", $id);
        if ($data["values"] == null)
            die(json_encode(["status" => 400, "desc" => "Time slot not found."]));

        // print_r($data["values"]);
        // die;

        //status = 0 => created
        //status = 1 => accepted
        //status = 2 => declined
        //status = 3 => accepted and completed
        //status = 4 => accepted and canceled

        $data["values"]["status"] = 2;

        $result = $this->model('updateModel')->update_one("reservation_requests", $data["values"], $data["reservation_template"], "id", $id, "i");

        // print_r($data["values"]);
        // die;

        if ($result) {
            $task = "Counselor declined a reservation.";
            $this->model("createModel")->createLogEntry($task, "200");
            die(json_encode(["status" => 200, "desc" => "Reservation Declined."]));
        } else {
            die(json_encode(["status" => 400, "desc" => "Error Declining Reservation."]));
        }
    }
}
