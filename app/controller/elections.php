<?php
class Elections extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/elections");
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
        $election = $this->model('readModel')->getOne("elections", $id);
        if (!$election)
            $this->redirect();

        if (isset($_POST['modify'])) {
            $values = $_POST["modify"];

            $questions = [];
            $valid_types = [1, 2, 3, 4];
            // 1 - short answer
            // 2 - multiple
            // 3 - checkbox
            // 4 - dropdown

            foreach ($values["questions"] as $key => $value) {
                $question["id"] = $value["id"];
                $question["election_id"] = $id;
                $question["question"] = $value["question"];
                $question["question_type"] = $value["question_type"];
                $question["question_options"] = "";

                if (!in_array($question["question_type"], $valid_types))
                    die(json_encode(array("status" => "400", "desc" => "Invalid Question Format")));

                $this->validate_template($question, $data["item_template"]);

                if ($question["question_type"] != 1) {
                    if (count($value["options"]) <= 0)
                        die(json_encode(array("status" => "400", "desc" => "Include at least 1 option")));

                    // check if empty options
                    foreach ($value["options"] as $key => $option) {
                        if ($option["option"] == "")
                            die(json_encode(array("status" => "400", "desc" => "Option cannot be empty")));
                    }

                    $question["question_options"] = json_encode($value['options']);
                }

                $questions[] = $question;
            }

            $result = $this->model('updateModel')->update_election_questions(
                $questions,
                $id,
                $data["item_template"],
                array_map('intval', $values["removed_questions"])
            );
            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Error while modifying election")));
        }

        $data["id"] = $id;
        $data["questions"] = $this->model('readModel')->getAllByColumn("election_questions", "election_id", $id, "i");
        if (!$data["questions"])
            $data["questions"] = [];

        // print_r($data["questions"]);
        // die;

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
