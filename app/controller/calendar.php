<?php
class Calendar extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/dashboard");
        die();
    }

    public function checkAdmin()
    {
        if ($_SESSION["student_rep"] != 1)
            $this->redirect();
    }


    public function index()
    {
        $this->requireLogin();
        $this->checkAdmin();

        $data = [
            'title' => 'Calendar',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["items"] = $this->model('readModel')->getAllPublicEvents();

        $this->view->render('calendar/index', $data);
    }

    // -- is_broadcast
    // --     0 - Personal
    // --     1 - Broadcast


    // -- target
    // --    0 - All
    // --    5 - All Students
    // --      1 - Student - 1st Year
    // --      2 - Student - 2nd Year
    // --      3 - Student - 3rd Year
    // --      4 - Student - 4th Year
    // --    6 - Counsellor

    // CREATE TABLE calendar (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     user_id INT DEFAULT NULL,
    //     is_broadcast TINYINT(1) NOT NULL DEFAULT 0,
    //     target TINYINT(1) NOT NULL DEFAULT 0,
    //     title VARCHAR(255) NOT NULL,
    //     module VARCHAR(255) DEFAULT NULL,
    //     description TEXT DEFAULT NULL,
    //     date DATETIME NOT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (user_id) REFERENCES user(id)
    // );


    public function add_edit($id = 0, $action = "create")
    {
        $this->requireLogin();
        $this->checkAdmin();

        $event = null;
        if ($id != 0) {
            $event = $this->model('readModel')->getOne("calendar", $id);
            if (!$event)
                $this->redirect();
        }

        $data = [
            'title' => ($id == "create") ? 'Create Calendar Event' : 'Edit Calendar Event',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["item_template"] = $this->model('readModel')->getEmptyCalendarEvent();
        $data["item"] = $data["item_template"]["empty"];
        $data["item_template"] = $data["item_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];
            $values["is_broadcast"] = 1;

            $this->validate_template($values, $data["item_template"]);

            $date = new DateTime($values["date"]);

            if ($values["target"] < 1 || $values["target"] > 5)
                die(json_encode(array("status" => "400", "desc" => "Invalid target")));

            if ($date == false)
                die(json_encode(array("status" => "400", "desc" => "Invalid datetime")));

            $now = new DateTime();
            if ($date < $now)
                die(json_encode(array("status" => "400", "desc" => "Date cannot be in the past")));

            if ($id == 0)
                $result = $this->model('createModel')->insert_db("calendar", $values, $data["item_template"]);
            else
                $result = $this->model('updateModel')->update_one("calendar", $values, $data["item_template"], "id", $id, "i");

            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Calendar Event Created Successfully")));
            die(json_encode(array("status" => "400", "desc" => "Error while " . $action . "ing calendar event")));
        }

        $data["id"] = $id;
        $data["action"] = $action;
        if ($id != 0)
            $data["item"] = $event;


        $this->view->render('calendar/add_edit', $data);
    }

    public function view($date = "")
    {
        $this->requireLogin();
        $this->checkAdmin();

        $data = [
            'title' => 'Calendar',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["items"] = $this->model('readModel')->getUserCalendarEvents($date);
        print_r($data["items"]);
        die;

        $this->view->render('calendar/view', $data);
    }

    public function get_events()
    {
        $this->requireLogin();

        // $this->requireLogin();
        // $notifications = $this->model('readModel')->getNotifications();
        // print_r($notifications);

        $events = $this->model('readModel')->getUserCalendarEvents();
        die(json_encode(array("status" => "200", "desc" => "Success", "events" => $events)));
    }

    public function delete($id = 0)
    {
        $this->requireLogin();
        $this->checkAdmin();

        if ($id == 0)
            $this->redirect();

        $result = $this->model('deleteModel')->delete_one("calendar", "id", $id, "i");

        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Calendar Event Deleted Successfully")));
        die(json_encode(array("status" => "400", "desc" => "Error while deleting calendar event")));
    }
}
