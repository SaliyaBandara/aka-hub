<?php
class Courses extends Controller
{

    public function redirect()
    {
        header("Location: " . BASE_URL . "/courses");
        die();
    }

    public function index()
    {
        $this->requireLogin();
        
        $data = [
            'title' => 'Courses',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["teaching_student"] = $_SESSION["teaching_student"];
        $data["courses"] = $this->model('readModel')->getAll("courses");
        $this->view->render('student/courses/index', $data);
    }

    public function add_edit($id = 0, $action = "create")
    {
        $this->requireLogin();
        if ($_SESSION["teaching_student"] != 1)
            $this->redirect();

        $data = [
            'title' => ($action == "create") ? 'Create Course' : 'Edit Course',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["course_template"] = $this->model('readModel')->getEmptyCourse();
        $data["course"] = $data["course_template"]["empty"];
        $data["course_template"] = $data["course_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];
            $this->validate_template($values, $data["course_template"]);

            if ($id == 0)
                $result = $this->model('createModel')->insert_db("courses", $values, $data["course_template"]);
            else
                $result = $this->model('updateModel')->update_one("courses", $values, $data["course_template"], "id", $id, "i");

            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Error while " . $action . "ing course")));
        }

        $data["id"] = $id;
        $data["action"] = $action;

        if ($id != 0) {
            $data["course"] = $this->model('readModel')->getOne("courses", $id);
            if (!$data["course"])
                $this->redirect();
        }

        // print params
        // print_r($id);
        // print_r($action);

        $this->view->render('student/courses/add_edit', $data);
    }

    public function delete($id = 0)
    {
        
        $this->requireLogin();
        if ($_SESSION["teaching_student"] != 1)
            $this->redirect();

        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Please provide a valid course id")));

        $result = $this->model('deleteModel')->deleteOne("courses", $id);
        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));

        die(json_encode(array("status" => "400", "desc" => "Error while deleting course")));
    }
}
