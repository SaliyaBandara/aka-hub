<?php
class Elections extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/courses");
        die();
    }

    public function index()
    {
        $this->requireLogin();

        $data = [
            'title' => 'Elections',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["teaching_student"] = $_SESSION["teaching_student"];
        $data["student_rep"] = $_SESSION["student_rep"];
        $data["items"] = $this->model('readModel')->getAll("elections");
        $this->view->render('election/elections/index', $data);
    }

    public function add_edit($id = 0, $action = "create")
    {
        $this->requireLogin();
        if (($_SESSION["student_rep"] != 1))
            $this->redirect();

        $data = [
            'title' => ($action == "create") ? 'Create Election' : 'Edit Election',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["item_template"] = $this->model('readModel')->getEmptyElection();
        $data["item"] = $data["item_template"]["empty"];
        $data["item_template"] = $data["item_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];
            $values["user_id"] = $_SESSION["user_id"];
            $this->validate_template($values, $data["item_template"]);

            // CREATE TABLE elections (
            //     id INT AUTO_INCREMENT PRIMARY KEY,
            //     user_id INT NOT NULL,
            //     name VARCHAR(255) NOT NULL,
            //     start_date DATETIME NOT NULL,
            //     end_date DATETIME NOT NULL,
            //     cover_img VARCHAR(255) DEFAULT NULL,
            //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            //     FOREIGN KEY (user_id) REFERENCES user(id)
            // );

            // validate dates
            $start_date = new DateTime($values["start_date"]);
            $end_date = new DateTime($values["end_date"]);

            if ($start_date == false)
                die(json_encode(array("status" => "400", "desc" => "Invalid start date")));
            if ($end_date == false)
                die(json_encode(array("status" => "400", "desc" => "Invalid end date")));

            if ($start_date > $end_date)
                die(json_encode(array("status" => "400", "desc" => "Start date cannot be after end date")));

            $now = new DateTime();
            if ($start_date < $now)
                die(json_encode(array("status" => "400", "desc" => "Start date cannot be in the past")));

            if ($id == 0)
                $result = $this->model('createModel')->insert_db("elections", $values, $data["item_template"]);
            else
                $result = $this->model('updateModel')->update_one("elections", $values, $data["item_template"], "id", $id, "i");

            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Error while " . $action . "ing election")));
        }

        $data["id"] = $id;
        $data["action"] = $action;

        if ($id != 0) {
            $data["item"] = $this->model('readModel')->getOne("elections", $id);
            if (!$data["item"])
                $this->redirect();
        }

        // print params
        // print_r($id);
        // print_r($action);

        $this->view->render('election/elections/add_edit', $data);
    }

    public function modify($id = 0)
    {
        $this->requireLogin();
        if (($_SESSION["student_rep"] != 1))
            $this->redirect();

        $data = [
            'title' => 'Modify Election',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["item_template"] = $this->model('readModel')->getEmptyElectionQuestion();
        $data["item"] = $data["item_template"]["empty"];
        $data["item_template"] = $data["item_template"]["template"];

        $data["id"] = $id;

        $this->view->render('election/elections/modify', $data);
    }

    public function delete($id = 0)
    {

        $this->requireLogin();
        if ($_SESSION["student_rep"] != 1)
            $this->redirect();

        die(json_encode(array("status" => "403", "desc" => "Still in development")));

        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Please provide a valid election id")));

        // $result = $this->model('deleteModel')->deleteOne("elections", $id);
        // if ($result)
        //     die(json_encode(array("status" => "200", "desc" => "Operation successful")));

        die(json_encode(array("status" => "400", "desc" => "Error while deleting election")));
    }
}
