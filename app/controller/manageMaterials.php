<?php
class ManageMaterials extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "User tried to view manage materials page";
            $state = 400;
            $this->model("createModel")->createLogEntry($action, $state);

            $this->redirect();
        }
        $data = [
            'title' => 'Manage Materials',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["materials"] = $this->model('readModel')->getMaterials();
        $this->view->render('admin/manageMaterials/index', $data);
    }

    public function view($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1){
            $action = "User tried to view a specific material";
            $state = 400;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        $data = [
            'title' => 'Manage Materials',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["role"] = $_SESSION["user_role"];

        $data["id"] = $id;
        $data["course"] = $this->model('readModel')->getOne("course_materials", $id);
        if (!$data["course"])
            $this->redirect();

        $data["viewMaterial"] = $this->model('readModel')->getMaterialToView($id);
        $this->view->render('admin/manageMaterials/view', $data);
    }

    public function material($action = "add_edit", $course_id = 0, $id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1){
            $action = "User tried to add edit material without permission";
            $state = 400;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        if ($course_id == 0)
            $this->redirect();

        $data = [
            'title' => $id == 0 ? 'Add Course Material' : 'Edit Course Material',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["course"] = $this->model('readModel')->getOne("courses", $course_id);
        if (!$data["course"])
            $this->redirect();

        $data["data_template"] = $this->model('readModel')->getEmptyCourseMaterial();
        $data["material"] = $data["data_template"]["empty"];
        $data["data_template"] = $data["data_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];

            $values["course_id"] = $course_id;
            $values["user_id"] = $_SESSION["user_id"];
            // $values["reference_links"] = json_encode($values["reference_links"]);
            if (isset($values["kuppi_video"]))
                $values["video_links"] = json_encode($values["kuppi_video"]);
            if (isset($values["course_materials"]))
                $values["short_notes"] = json_encode($values["course_materials"]);

            $this->validate_template($values, $data["data_template"]);

            if ($id == 0)
                $result = $this->model('createModel')->insert_db("course_materials", $values, $data["data_template"]);
                if($result){
                    $action = "Course material created successfully";
                    $state = 201;
                    $this->model("createModel")->createLogEntry($action, $state);
                }
            else{
                $result = $this->model('updateModel')->update_one("course_materials", $values, $data["data_template"], "id", $id, "i");
                if($result){
                    $action = "Course material updated successfully";
                    $state = 200;
                    $this->model("createModel")->createLogEntry($action, $state);
                }
            }
            if ($result)
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));

            die(json_encode(array("status" => "400", "desc" => "Error while " . $action . "ing course")));
        }

        if ($id != 0) {
            $data["material"] = $this->model('readModel')->getOne("course_materials", $id);
            if (!$data["material"])
                $this->redirect();
        }

        // print_r($data["material"]);

        $data["id"] = $id;
        $data["action"] = $action;

        $data["teaching_student"] = $_SESSION["teaching_student"];
        $this->view->render('admin/manageMaterials/add_edit_material', $data);
    }

    // delete material
    public function delete_material($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1){
            $action = "User tried to delete material without permission";
            $state = 400;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Please provide a valid course material id")));

        $result = $this->model('deleteModel')->deleteOne("course_materials", $id);
        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));

        die(json_encode(array("status" => "400", "desc" => "Error while deleting course material")));
    }

    public function add_edit($id = 0, $action = "create")
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1){ 
            $action = "User tried to add edit course without permission";
            $state = 400;
            $this->redirect();
        }
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
                if($result){
                    $action = "Course created successfully";
                    $state = 201;
                    $this->model("createModel")->createLogEntry($action, $state);
                }
            else
                $result = $this->model('updateModel')->update_one("courses", $values, $data["course_template"], "id", $id, "i");
                if($result){
                    $action = "Course updated successfully";
                    $state = 200;
                    $this->model("createModel")->createLogEntry($action, $state);
                }

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

        $this->view->render('admin/manageMaterials/add_edit', $data);
    }

    public function delete($id = 0)
    {

        $this->requireLogin();
        if ($_SESSION["user_role"] != 1){
            $action = "User tried to delete course without permission";
            $state = 400;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Please provide a valid course id")));

        $result = $this->model('deleteModel')->deleteOne("courses", $id);
        if ($result){
            $action = "Course deleted successfully";
            $state = 200;
            $this->model("createModel")->createLogEntry($action, $state);
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));
        }
        die(json_encode(array("status" => "400", "desc" => "Error while deleting course")));
    }
    
    public function viewMaterial($id)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1){
            $action = "User tried to view material without permission";
            $state = 400;
            $this->model("createModel")->createLogEntry($action, $state);

            $this->redirect();
        }
        $data = [
            'title' => 'Manage Materials',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["viewMaterial"] = $this->model('readModel')->getMaterialToView($id);
        $this->view->render('admin/manageMaterials/viewMaterial', $data);
    }
}
