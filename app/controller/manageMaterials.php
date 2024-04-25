<?php
class ManageMaterials extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized User tried to view manage materials page";
            $state = 401;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        $data = [
            'title' => 'Manage Materials',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["materials"] = $this->model('readModel')->getMaterials();
        if($data["materials"] == null)
            $this->redirect();
        $this->view->render('admin/manageMaterials/index', $data);
    }

    public function view($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized User tried to view a specific material";
            $state = 401;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        $data = [
            'title' => 'Manage Materials',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["role"] = $_SESSION["user_role"];
        if($data["role"] != 1)
            $this->redirect();
        $data["id"] = $id;
        if($id == 0)
            $this->redirect();
        $data["course"] = $this->model('readModel')->getOne("course_materials", $id);
        if (!$data["course"])
            $this->redirect();

        $data["viewMaterial"] = $this->model('readModel')->getMaterialToView($id);
        $this->view->render('admin/manageMaterials/view', $data);
    }

    public function material($action = "add_edit", $id = 0, $course_id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $task = "Unauthorized User tried to add edit material without permission";
            $state = 401;
            $this->model("createModel")->createLogEntry($task, $state);
            $this->redirect();
        }

        $data = [
            'title' => 'Edit Course Material',
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

            $result = $this->model('updateModel')->update_one("course_materials", $values, $data["data_template"], "id", $id, "i");
            if ($result) {
                $task1 = "Course material updated successfully";
                $state = 200;
                $this->model("createModel")->createLogEntry($task1, $state);
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));
            }
            die(json_encode(array("status" => "400", "desc" => "Error while " . $action . "ing course")));
        }

        if ($id != 0) {
            $data["material"] = $this->model('readModel')->getOne("course_materials", $id);
            if (!$data["material"])
                $this->redirect();
        }
        $data["id"] = $id;
        $data["action"] = $action;

        $this->view->render('admin/manageMaterials/add_edit_material', $data);
    }

    // delete material
    public function delete_material($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to delete material without permission";
            $state = 401;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        if ($id == 0) {
            die(json_encode(array("status" => "400", "desc" => "Please provide a valid course material id")));
        }
        $result = $this->model('deleteModel')->deleteOne("course_materials", $id);
        if ($result) {
            $action = "Course material deleted successfully";
            $state = 200;
            $this->model("createModel")->createLogEntry($action, $state);
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));
        }
        die(json_encode(array("status" => "400", "desc" => "Error while deleting course material")));
    }
}
