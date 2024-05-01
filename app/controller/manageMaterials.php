<?php
class ManageMaterials extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 1) && ($_SESSION["student_rep"] != 1) && ($_SESSION["teaching_student"] != 1)) {
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
        if (!$data["materials"])
            $data["materials"] = array();
        $this->view->render('admin/manageMaterials/index', $data);
    }

    public function view($id = 0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 1) && ($_SESSION["student_rep"] != 1) && ($_SESSION["teaching_student"] != 1)) {
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

        $data["id"] = $id;
        $data["course"] = $this->model('readModel')->getOne("course_materials", $id);
        if (!$data["course"])
            $this->redirect();

        $data["viewMaterial"] = $this->model('readModel')->getMaterialToView($id);
        $this->view->render('admin/manageMaterials/view', $data);
    }

    public function material($action = "add_edit", $id = 0, $course_id = 0)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 1) && ($_SESSION["student_rep"] != 1) && ($_SESSION["teaching_student"] != 1)) {
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

        $data["data_template"] = $this->model('readModel')->getEmptyCourseMaterialForAdmin();
        $data["material"] = $data["data_template"]["empty"];
        $data["data_template"] = $data["data_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];
            $values["course_id"] = $course_id;
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
        if (($_SESSION["user_role"] != 1) && ($_SESSION["student_rep"] != 1) && ($_SESSION["teaching_student"] != 1)) {
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

    public function courses()
    {

        $this->requireLogin();
        if (($_SESSION["user_role"] != 1) && ($_SESSION["student_rep"] != 1) && ($_SESSION["teaching_student"] != 1)) {
            $action = "Unauthorized User tried to view manage courses page";
            $state = 401;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        $data = [
            'title' => 'Manage Courses',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["courses"] = $this->model('readModel')->getCourses();
        if (!$data["courses"])
            $data["courses"] = array();
        $this->view->render('admin/manageMaterials/courses', $data);
    }

    public function courseView($id)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 1) && ($_SESSION["student_rep"] != 1) && ($_SESSION["teaching_student"] != 1)) {
            $action = "Unauthorized User tried to view a specific course";
            $state = 401;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        $data = [
            'title' => 'Manage Courses',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["role"] = $_SESSION["user_role"];

        $data["id"] = $id;
        $data["course"] = $this->model('readModel')->getOne("courses", $id);
        if (!$data["course"])
            $this->redirect();
        $this->view->render('admin/manageMaterials/courseView', $data);
    }

    public function courseEdit($id)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 1) && ($_SESSION["student_rep"] != 1) && ($_SESSION["teaching_student"] != 1)) {
            $task = "Unauthorized User tried to edit a specific course";
            $state = 401;
            $this->model("createModel")->createLogEntry($task, $state);
            $this->redirect();
        }
        $data = [
            'title' => 'Edit Course',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["course"] = $this->model('readModel')->getOne("courses", $id);
        if (!$data["course"])
            $this->redirect();

        $data["data_template"] = $this->model('readModel')->getEmptyCourseForAdmin();
        $data["material"] = $data["data_template"]["empty"];
        $data["data_template"] = $data["data_template"]["template"];

        if (isset($_POST['add_edit'])) {
            $values = $_POST["add_edit"];
            if ($id != 0) {
                $result = $this->model('readModel')->isCourseExist($values["name"]);
                if ($result && $result["id"] != $id) {
                    die(json_encode(array("status" => "400", "desc" => "Course exists with the same name")));
                }
                $result = $this->model('readModel')->isCodeExist($values["code"]);
                if ($result && $result["id"] != $id) {
                    die(json_encode(array("status" => "400", "desc" => "Course exists with the same code")));
                }
                if (($values["year"] < 1) || ($values["year"] > 4)) {
                    die(json_encode(array("status" => "400", "desc" => "Please provide a valid year")));
                }
                if (($values["semester"] < 1) || ($values["semester"] > 2)) {
                    die(json_encode(array("status" => "400", "desc" => "Please provide a valid semester")));
                }
            }


            $values["course_id"] = $id;
            $this->validate_template($values, $data["data_template"]);
            $result = $this->model('updateModel')->update_one("courses", $values, $data["data_template"], "id", $id, "i");
            if ($result) {
                $task1 = "Course updated successfully";
                $state = 200;
                $this->model("createModel")->createLogEntry($task1, $state);
                die(json_encode(array("status" => "200", "desc" => "Operation successful")));
            }
            die(json_encode(array("status" => "400", "desc" => "Error while updating course")));
        }
        $data["id"] = $id;
        $this->view->render('admin/manageMaterials/add_edit_course', $data);
    }

    public function deleteCourse($id)
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 1) && ($_SESSION["student_rep"] != 1) && ($_SESSION["teaching_student"] != 1)) {
            $action = "Unauthorized User tried to delete a course";
            $state = 401;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Please provide a valid course id")));

        $result = $this->model('deleteModel')->deleteOne("courses", $id);
        if ($result) {
            $task = "Course deleted successfully";
            $state = "200";
            $this->model("createModel")->createLogEntry($task, $state);
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));
        }
        die(json_encode(array("status" => "400", "desc" => "Error while deleting course")));
    }
}
