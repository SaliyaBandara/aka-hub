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
        if ($_SESSION["student_rep"] != 1 && $_SESSION["club_rep"] != 1)
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

    // TODO: bulk add events, parse exam timetable pdf and add events

    public function parse_timetable()
    {
        $this->requireLogin();
        $this->checkAdmin();

        $data = [
            'title' => 'Parse Timetable',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["item_template"] = $this->model('readModel')->getEmptyCalendarEvent();
        $data["item"] = $data["item_template"]["empty"];
        $data["item_template"] = $data["item_template"]["template"];

        //         Array
        // (
        //     [0] => Array
        //         (
        //             [Date] => 18.03.2024
        //             [Time] => 09:00 am - 11:00 am
        //             [Year] => 2
        //             [Subject Code] => SCS 2209
        //             [Subject Name] => Database II
        //             [Venue] => 4th Floor
        //         )

        //     [1] => Array
        //         (
        //             [Date] => 18.03.2024
        //             [Time] => 09:00 am - 11:00 am
        //             [Year] => 2
        //             [Subject Code] => SCS 2209
        //             [Subject Name] => Database II
        //             [Venue] => Mini
        //         )

        if (isset($_POST["parse_pdf"])) {
            $values = $_POST["parse_pdf"];
            if (!isset($values["exam_timetable"]) || count($values["exam_timetable"]) <= 0)
                die(json_encode(array("status" => "400", "desc" => "Please upload the exam timetable PDF")));

            $exam_timetable = $values["exam_timetable"][0];

            // get absolute current path
            // $current_path = getcwd();
            // $python_path = $current_path . "/../hidden/pdf_parser/final.py";

            $dir = dirname(__FILE__);
            $root = implode(DIRECTORY_SEPARATOR, array_slice(explode(DIRECTORY_SEPARATOR, $dir), 0, -1));

            $python_path = str_replace("app", "hidden", $root) . "\\pdf_parser\\final.py";
            $exam_timetable = str_replace("app", "public\\assets\\user_uploads\\pdf", $root) . "\\" . $exam_timetable;

            // echo $python_path;
            // echo "python $python_path \"$exam_timetable\"";

            $output = shell_exec("python $python_path \"$exam_timetable\"");
            // json decode the output
            // $output = json_decode($output, true);
            // print_r($output);
            // die;

            die(json_encode(array("status" => "200", "desc" => "Exam Timetable Parsed Successfully", "output" => $output)));
        }

        if (isset($_POST["add_edit"])) {
            // save the parsed timetable to the database
            $values = $_POST["add_edit"];

            // convert the parsed timetable to the correct format for the database
            $parsed_timetable = $values;
            // $parsed_timetable = json_decode($parsed_timetable, true);
            // print_r($parsed_timetable);

            $cleaned_timetable = [];
            foreach ($parsed_timetable as $key => $value) {
                $description = $value["Subject Name"] . " - " . $value["Subject Code"] . " - " . $value["Venue"];

                // if any of the values are empty, skip this iteration
                if (empty($value["Date"]) || empty($value["Time"]) || empty($value["Year"]) || empty($value["Subject Code"]) || empty($value["Subject Name"]) || empty($value["Venue"]))
                    continue;

                $date = $value["Date"] . " " . $value["Time"];
                $date = explode(" - ", $date)[0];

                $date = DateTime::createFromFormat('d.m.Y h:i a', $date);
                if ($date == false)
                    continue;

                $date = $date->format('Y-m-d H:i:s');

                // ensure year is between 1 and 4
                if ($value["Year"] < 1 || $value["Year"] > 4)
                    $value["Year"] = 5;

                $year = $value["Year"];
                $title = $value["Subject Code"] . " - " . $value["Subject Name"];

                // check if values already exists in cleaned timetable with same title and date
                $exists = false;
                foreach ($cleaned_timetable as $key => $value) {
                    if ($value["title"] == $title && $value["date"] == $date) {
                        $exists = true;
                        break;
                    }
                }

                // print_r($value);
                // die;

                if (!$exists) {
                    $cleaned_timetable[] = [
                        "title" => $title,
                        "module" => $title,
                        "description" => $description,
                        "date" => $date,
                        "target" => $year,
                        "is_broadcast" => 1,
                        "type" => 1
                    ];
                }
            }

            // print_r($cleaned_timetable);
            // die;

            $result = $this->model('createModel')->insert_multiple("calendar", $cleaned_timetable, $data["item_template"]);
            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Timetable Successfully Parsed and Added to Calendar")));
            die(json_encode(array("status" => "400", "desc" => "Error while parsing timetable")));
        }

        $this->view->render('calendar/parse_timetable', $data);
    }

    public function view($date = "")
    {
        $this->requireLogin();
        $data = [
            'title' => 'Calendar',
            'message' => 'Welcome to Aka Hub!'
        ];

        $date = filter_var($date, FILTER_SANITIZE_NUMBER_INT);
        $unixTimestamp = $date;

        $timestampSeconds = $date / 1000;
        $date = date("Y-m-d", $timestampSeconds);
        if (strtotime($date) === false)
            $this->redirect();

        // print_r($date);

        // Wednesday, 10 April 2024
        $date = date("l, j F Y", strtotime($date));
        $data["date"] = $date;

        $data["items"] = $this->model('readModel')->getUserCalendarEvents($unixTimestamp);

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

        $result = $this->model('deleteModel')->deleteOne("calendar", $id);

        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Calendar Event Deleted Successfully")));
        die(json_encode(array("status" => "400", "desc" => "Error while deleting calendar event")));
    }
}
