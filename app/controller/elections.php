<?php
class Elections extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/elections");
        die();
    }

    public function checkAdmin()
    {
        if ($_SESSION["student_rep"] != 1 && $_SESSION["club_rep"] != 1 &&  $_SESSION["user_role"] != 1)
            $this->redirect();
    }

    public function checkAccess($election)
    {
        // if student rep type should be 1
        // if club rep type should be 0
        if ($_SESSION["student_rep"] == 1)
            return true;

        if ($_SESSION["club_rep"] == 1 && $election["type"] == 0)
            return true;

        if ($_SESSION["user_role"] == 1)
            return true;

        return false;
    }
    public function index()
    {
        $this->requireLogin();

        $data = [
            'title' => 'Elections',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["student_rep"] = $_SESSION["student_rep"];
        $data["club_rep"] = $_SESSION["club_rep"];

        $data["edit_access"] = false;
        if ($_SESSION["student_rep"] == 1 || $_SESSION["club_rep"] == 1 || $_SESSION["user_role"] == 1)
            $data["edit_access"] = true;

        // getAllSort($table, $column, $order)
        $data["items"] = $this->model('readModel')->getAllSort("elections", "start_date", "DESC");
        $this->view->render('election/view/index', $data);
    }

    public function dashboard()
    {
        $this->requireLogin();
        $this->checkAdmin();

        $data = [
            'title' => 'Elections',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["student_rep"] = $_SESSION["student_rep"];
        $data["club_rep"] = $_SESSION["club_rep"];

        $data["items"] = $this->model('readModel')->getAll("elections");
        $this->view->render('election/dashboard/index', $data);
    }

    public function view($id = 0)
    {
        $this->requireLogin();

        $data = [
            'title' => 'Election',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["item"] = $this->model('readModel')->getOne("elections", $id);
        if (!$data["item"])
            $this->redirect();

        $data["questions"] = $this->model('readModel')->getAllByColumn("election_questions", "election_id", $id, "i");
        if (!$data["questions"])
            $data["questions"] = [];

        if (isset($_POST["vote"])) {
            $values = $_POST["vote"];

            $data["election_response"] = $this->model('readModel')->getEmptyElectionResponse();
            $data["election_response_template"] = $data["election_response"]["template"];

            $election_id = $id;
            $user_id = $_SESSION["user_id"];
            $questions = $this->model('readModel')->getAllByColumn("election_questions", "election_id", $election_id, "i");
            if (!$questions)
                die(json_encode(array("status" => "400", "desc" => "No questions found for this election")));

            // check if already voted
            $already_voted = $this->model('readModel')->getOneByColumns("election_votes", ["election_id", "user_id"], [$election_id, $user_id], ["i", "i"]);
            if ($already_voted)
                die(json_encode(array("status" => "400", "desc" => "You have already voted for this election")));

            // check if the count of questions and answers match
            if (count($questions) != count($values))
                die(json_encode(array("status" => "400", "desc" => "Invalid number of answers")));

            // sort both arrays by question id
            usort($questions, function ($a, $b) {
                return $a["id"] - $b["id"];
            });

            usort($values, function ($a, $b) {
                return $a["question_id"] - $b["question_id"];
            });

            $answers = [];
            foreach ($values as $key => $value) {
                $question_id = $value["question_id"];
                $question = $questions[$key];
                if ($question_id != $question["id"])
                    die(json_encode(array("status" => "400", "desc" => "Invalid question id " . $question_id)));

                $question_type = $question["question_type"];
                $question_answers = $value["question_answer"];

                if ($question_type != 1) {
                    if (count($question_answers) <= 0)
                        die(json_encode(array("status" => "400", "desc" => "Invalid answer for question id " . $question_id)));

                    foreach ($question_answers as $key => $answer) {
                        $answers[] = [
                            "election_id" => $election_id,
                            "user_id" => $user_id,
                            "question_id" => $question_id,
                            "answer" => $answer
                        ];
                    }
                }
            }

            $result = $this->model('createModel')->insert_election_answers($id, $answers, $data["election_response_template"]);
            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Votes Cast Successfully")));

            die(json_encode(array("status" => "400", "desc" => "Error while voting")));
        }


        // CREATE TABLE elections (
        //     id INT AUTO_INCREMENT PRIMARY KEY,
        //     user_id INT NOT NULL,
        //     name VARCHAR(255) NOT NULL,
        //     description TEXT DEFAULT NULL,
        //     start_date DATETIME NOT NULL,
        //     end_date DATETIME NOT NULL,
        //     cover_img VARCHAR(255) DEFAULT NULL,
        //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     type TINYINT(1) NOT NULL DEFAULT 0,
        //     FOREIGN KEY (user_id) REFERENCES user(id)
        // );

        // -- election questions table

        // CREATE TABLE election_questions (
        //     id INT AUTO_INCREMENT PRIMARY KEY,
        //     election_id INT NOT NULL,
        //     question VARCHAR(255) NOT NULL,
        //     question_type VARCHAR(255) NOT NULL,
        //     question_options TEXT DEFAULT NULL,
        //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     FOREIGN KEY (election_id) REFERENCES elections(id)
        // );

        // -- election votes table

        // CREATE TABLE election_votes (
        //     id INT AUTO_INCREMENT PRIMARY KEY,
        //     election_id INT NOT NULL,
        //     user_id INT NOT NULL,
        //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     FOREIGN KEY (election_id) REFERENCES elections(id),
        //     FOREIGN KEY (user_id) REFERENCES user(id)
        // );

        // -- election responses table

        // CREATE TABLE election_responses (
        //     id INT AUTO_INCREMENT PRIMARY KEY,
        //     election_id INT NOT NULL,
        //     user_id INT NOT NULL,
        //     question_id INT NOT NULL,
        //     response_option VARCHAR(255) DEFAULT NULL,
        //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     FOREIGN KEY (election_id) REFERENCES elections(id),
        //     FOREIGN KEY (user_id) REFERENCES user(id),
        //     FOREIGN KEY (question_id) REFERENCES election_questions(id)
        // );

        // get election analytics

        $data["analytics"] = $this->model('readModel')->getElectionAnalytics($id);
        // print_r($data["analytics"]);
        // die;

        $election_id = $id;
        $user_id = $_SESSION["user_id"];
        $already_voted = $this->model('readModel')->getOneByColumns("election_votes", ["election_id", "user_id"], [$election_id, $user_id], ["i", "i"]);
        $data["already_voted"] = false;
        if ($already_voted)
            $data["already_voted"] = true;

        $this->view->render('election/view/view', $data);
    }

    public function add_edit($id = 0, $action = "create")
    {
        $this->requireLogin();
        $this->checkAdmin();

        if ($id != 0) {
            $election = $this->model('readModel')->getOne("elections", $id);
            if (!$election || !$this->checkAccess($election))
                $this->redirect();
        }

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
            //     target TINYINT(1) NOT NULL DEFAULT 1,
            //     name VARCHAR(255) NOT NULL,
            //     description TEXT DEFAULT NULL,
            //     start_date DATETIME NOT NULL,
            //     end_date DATETIME NOT NULL,
            //     cover_img VARCHAR(255) DEFAULT NULL,
            //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            //     type TINYINT(1) NOT NULL DEFAULT 0,
            //     FOREIGN KEY (user_id) REFERENCES user(id)
            // );

            // validate dates
            $start_date = new DateTime($values["start_date"]);
            $end_date = new DateTime($values["end_date"]);

            $values["type"] = 0;
            if ($id == 0 && $_SESSION["student_rep"] == 1)
                $values["type"] = 1;

            // target should be int within 1 to 5
            if ($values["target"] < 1 || $values["target"] > 5)
                die(json_encode(array("status" => "400", "desc" => "Invalid target")));

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

            if ($result) {
                if ($id == 0) {
                    $id = $result;

                    // create notification
                    $values["start_date"] = date("jS M Y", strtotime($values["start_date"]));
                    $notif_message = "Upcoming election: $values[name] starting on $values[start_date]";
                    $this->model('createModel')->notification(5, $id, 0, $values["name"], $notif_message, $values["target"], "/elections/view/$id");
                }
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));
            }

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

        $this->view->render('election/dashboard/add_edit', $data);
    }

    public function modify($id = 0)
    {
        $this->requireLogin();
        $this->checkAdmin();

        $data = [
            'title' => 'Modify Election',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["item_template"] = $this->model('readModel')->getEmptyElectionQuestion();
        $data["item"] = $data["item_template"]["empty"];
        $data["item_template"] = $data["item_template"]["template"];
        $election = $this->model('readModel')->getOne("elections", $id);
        if (!$election || !$this->checkAccess($election))
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

                    $has_images = false;
                    $img_count = 0;
                    foreach ($value["options"] as $option) {
                        if (isset($option["cover_img"])) {
                            $has_images = true;
                            $img_count++;
                        }
                    }

                    if ($has_images && $img_count != count($value["options"]))
                        die(json_encode(array("status" => "400", "desc" => "Upload images for all options if any")));

                    $question["question_options"] = json_encode($value['options']);
                }

                $questions[] = $question;
            }

            $removed_questions = [];
            if (isset($values["removed_questions"]) && count($values["removed_questions"]) > 0)
                $removed_questions = $values["removed_questions"];

            $result = $this->model('updateModel')->update_election_questions(
                $questions,
                $id,
                $data["item_template"],
                array_map('intval', $removed_questions)
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

        $this->view->render('election/dashboard/modify', $data);
    }

    public function delete($id = 0)
    {
        $this->requireLogin();
        $election = $this->model('readModel')->getOne("elections", $id);
        if (!$election || !$this->checkAccess($election))
            die(json_encode(array("status" => "403", "desc" => "Access denied")));

        die(json_encode(array("status" => "403", "desc" => "Still in development")));

        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Please provide a valid election id")));

        // $result = $this->model('deleteModel')->deleteOne("elections", $id);
        // if ($result)
        //     die(json_encode(array("status" => "200", "desc" => "Operation successful")));

        die(json_encode(array("status" => "400", "desc" => "Error while deleting election")));
    }
}
