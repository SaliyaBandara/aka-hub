<?php
class Courses extends Controller
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
            'title' => 'Courses',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["buttonValue"] = " Go To Archieved Courses";
        $data["link"] = "viewArchievedCourses";
        $data["iClass"] = "bx-archive-in";
        $data["topic"] = "Onoing Courses in Your Year";
        $data["filter"] = 1;

        $data["teaching_student"] = $_SESSION["teaching_student"];
        $data["student_rep"] = $_SESSION["student_rep"];

        $data["student"] = $this->model('readModel')->getUserDetails($_SESSION["user_id"]);
        $year = $data["student"][0]["year"];

        $data["courses"] = $this->model('readModel')->getCoursesByYear($year);

        $this->view->render('student/courses/index', $data);
    }

    public function viewArchievedCourses()
    {
        $this->requireLogin();

        $data = [
            'title' => 'Courses',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["buttonValue"] = "Go To Ongoing Courses";
        $data["link"] = "index";
        $data["iClass"] = "bx-archive-out";
        $data["topic"] = "Archieved Courses";
        $data["filter"] = 2;

        $data["teaching_student"] = $_SESSION["teaching_student"];
        $data["student_rep"] = $_SESSION["student_rep"];

        $data["student"] = $this->model('readModel')->getUserDetails($_SESSION["user_id"]);

        $year = $data["student"][0]["year"];

        $data["courses"] = $this->model('readModel')->getCoursesBelowYear($year);

        $this->view->render('student/courses/index', $data);
    }

    public function filter(){

        $this->requireLogin();
        $data = [
            'title' => 'Event Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["teaching_student"] = $_SESSION["teaching_student"];
        $data["student_rep"] = $_SESSION["student_rep"];

        $semester = $_POST['semester'];

        $data["student"] = $this->model('readModel')->getUserDetails($_SESSION["user_id"]);
        $year = $data["student"][0]["year"];

        if($semester == 0){
            $data["courses"] = $this->model('readModel')->getCoursesByYear($year);
        }
        else{

            $data["courses"] = $this->model('readModel')->getCoursesBySemester($year,(int)$semester);
        }

        $BASE_URL =  BASE_URL ;

        if(empty($data["courses"])){
            echo "<div class='font-meidum text-muted'> No courses added! </div>";
        }
        else{
            foreach ($data["courses"] as $course) {     
                echo '
                    <div href="./courses/view/'.$course["id"].'" class="js-link todo_item flex align-center">
                            <div>
                                <div class="todo_item_date flex align-center justify-center">
                                    <img src= '.USER_IMG_PATH . $course["cover_img"].' alt="">
                                </div>
                            </div>
                            <div class="todo_item_text">
                                <div class="font-1-25 font-semibold"> '.$course["name"] .'</div>
                                <div class="font-1 font-medium text-muted"> '.$course["code"].'</div>
                                <div class="font-0-8 text-muted">Year '. $course["year"].' Semester '. $course["semester"] .'</div>
                            </div>
                ';

                            if (($data["teaching_student"] == 1)||($data["student_rep"])) {
                                echo '
                                    <div class="todo_item_actions">
                                        <a href="'. $BASE_URL.'/courses/add_edit/'. $course["id"] .'/edit" class="btn d-block m-1"> <i class="bx bx-edit"></i></a>
                                        <div class="btn delete-item" data-id= '.$course["id"].'>
                                            <i class="bx bx-trash text-danger"></i>
                                        </div>
                                    </div>
                                ';
                             }

                    echo '</div>';
            }
        }

    }

    public function filterBelow(){

        $this->requireLogin();
        $data = [
            'title' => 'Event Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["teaching_student"] = $_SESSION["teaching_student"];
        $data["student_rep"] = $_SESSION["student_rep"];

        $yearA = $_POST['yearA'];
        $semesterA = $_POST['semesterA'];

        $data["student"] = $this->model('readModel')->getUserDetails($_SESSION["user_id"]);
        $year = $data["student"][0]["year"];

        if($yearA == 0 && $semesterA == 0){
            $data["courses"] = $this->model('readModel')->getCoursesBelowYear($year);
        }
        else if($yearA > $year){
            $data["courses"] = 1;
        }
        else if($yearA == 0 && $semesterA != 0){
            $data["courses"] = $this->model('readModel')->getCoursesByOnlySemester($semesterA);
        }
        else if($yearA != 0 && $semesterA == 0){
            $data["courses"] = $this->model('readModel')->getCoursesByYear($yearA);
        }
        else{
            $data["courses"] = $this->model('readModel')->getCoursesBySemester($yearA,$semesterA);
        }

        $BASE_URL =  BASE_URL ;

        if(empty($data["courses"])){
            echo "<div class='font-meidum text-muted'> No courses added! </div>";
        }
        else if($data["courses"] == 1){
            echo "<div class='font-meidum text-muted'> Can't access this year! </div>";
        }
        else{
            foreach ($data["courses"] as $course) {     
                echo '
                    <div href="./view/'.$course["id"].'" class="js-link todo_item flex align-center">
                            <div>
                                <div class="todo_item_date flex align-center justify-center">
                                    <img src= '.USER_IMG_PATH . $course["cover_img"].' alt="">
                                </div>
                            </div>
                            <div class="todo_item_text">
                                <div class="font-1-25 font-semibold"> '.$course["name"] .'</div>
                                <div class="font-1 font-medium text-muted"> '.$course["code"].'</div>
                                <div class="font-0-8 text-muted">Year '. $course["year"].' Semester '. $course["semester"] .'</div>
                            </div>
                ';

                            if (($data["teaching_student"] == 1)||($data["student_rep"])) {
                                echo '
                                    <div class="todo_item_actions">
                                        <a href="'. $BASE_URL.'/courses/add_edit/'. $course["id"] .'/edit" class="btn d-block m-1"> <i class="bx bx-edit"></i></a>
                                        <div class="btn delete-item" data-id= '.$course["id"].'>
                                            <i class="bx bx-trash text-danger"></i>
                                        </div>
                                    </div>
                                ';
                             }

                    echo '</div>';
            }
        }

    }

    public function view($id = 0)
    {
        $this->requireLogin();

        // if ($id == 0)
        //     $this->redirect();

        $data = [
            'title' => 'Course',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["teaching_student"] = $_SESSION["teaching_student"];
        $data["student_rep"] = $_SESSION["student_rep"];
        $data["id"] = $id;
        $data["course"] = $this->model('readModel')->getOne("courses", $id);
        if (!$data["course"])
            $this->redirect();

        $data["material"] = $this->model('readModel')->getCourseMaterial($id);
        $data["teaching_student"] = $_SESSION["teaching_student"];

        // print_r($data["material"]);

        // $data["course"] = $this->model('readModel')->getOne("courses", $id);
        // if (!$data["course"])
        //     $this->redirect();

        $this->view->render('student/courses/view', $data);
    }

    public function material($action = "add_edit", $course_id = 0, $id = 0)
    {
        $this->requireLogin();
        if (($_SESSION["teaching_student"] != 1)&&($_SESSION["student_rep"]!=1)){
            $task = "Unauthorized User tried to add edit material without permission";
            $state = "401";
            $this->model("createModel")->createLogEntry($task, $state);
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

            if ($id == 0){
                $task = "Course material created successfully";
                $state = "201";
                $this->model("createModel")->createLogEntry($task, $state);
                $result = $this->model('createModel')->insert_db("course_materials", $values, $data["data_template"]);
            }else{
                $task = "Course material updated successfully";
                $state = "200";
                $this->model("createModel")->createLogEntry($task, $state);
                $result = $this->model('updateModel')->update_one("course_materials", $values, $data["data_template"], "id", $id, "i");
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
        $this->view->render('student/courses/add_edit_material', $data);
    }

    // delete material
    public function delete_material($id = 0)
    {
        $this->requireLogin();
        if (($_SESSION["teaching_student"] != 1)&&($_SESSION["student_rep"]!=1)){
            $task = "Unauthorized User tried to delete material without permission";
            $state = "401";
            $this->model("createModel")->createLogEntry($task, $state);
            $this->redirect();
        }
        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Please provide a valid course material id")));

        $result = $this->model('deleteModel')->deleteOne("course_materials", $id);
        if ($result){
            $task = "Course material deleted successfully";
            $state = "200";
            $this->model("createModel")->createLogEntry($task, $state);
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));
        }
        die(json_encode(array("status" => "400", "desc" => "Error while deleting course material")));
    }

    public function add_edit($id = 0, $action = "create")
    {
        $this->requireLogin();
        if (($_SESSION["teaching_student"] != 1)&&($_SESSION["student_rep"]!=1)){
            $task = "Unauthorized User tried to add edit course without permission";
            $state = "401";
            $this->model("createModel")->createLogEntry($task, $state);
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

            $data["student"] = $this->model('readModel')->getUserDetails($_SESSION["user_id"]);
            $year = $data["student"][0]["year"];

            $values["year"] = $year;

            $this->validate_template($values, $data["course_template"]);

            if ($id == 0){
                $task = "Course created successfully";
                $state = "201";
                $this->model("createModel")->createLogEntry($task, $state);
                $result = $this->model('createModel')->insert_db("courses", $values, $data["course_template"]);
            }else{
                $task = "Course updated successfully";
                $state = "200";
                $this->model("createModel")->createLogEntry($task, $state);
                $result = $this->model('updateModel')->update_one("courses", $values, $data["course_template"], "id", $id, "i");
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

        $this->view->render('student/courses/add_edit', $data);
    }

    public function delete($id = 0)
    {

        $this->requireLogin();
        if (($_SESSION["teaching_student"] != 1)&&($_SESSION["student_rep"]!=1)){
            $task = "Unauthorized User tried to delete course without permission";
            $state = "401";
            $this->model("createModel")->createLogEntry($task, $state);
            $this->redirect();
        }
        if ($id == 0)
            die(json_encode(array("status" => "400", "desc" => "Please provide a valid course id")));

        $result = $this->model('deleteModel')->deleteOne("courses", $id);
        if ($result){
            $task = "Course deleted successfully";
            $state = "200";
            $this->model("createModel")->createLogEntry($task, $state);
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));
        }
        die(json_encode(array("status" => "400", "desc" => "Error while deleting course")));
    }

    public function clickToBeRole($role)
    {
        $this->requireLogin();

        if ($_SESSION["$role"] == 1) {
            die(json_encode(array("status" => "400", "desc" => "You are already a $role")));
        } else if ($_SESSION["$role"] == 2) {
            die(json_encode(array("status" => "400", "desc" => "Already requested")));
        } else if ($_SESSION["$role"] == 0) {

            $result = $this->model('updateModel')->to_get_role(
                "user",
                $role,
                $_SESSION["user_id"],
                2
            );
            if ($result){
                $task = "User requested to be a role";
                $state = "200";
                $this->model("createModel")->createLogEntry($task, $state);
                die(json_encode(array("status" => "200", "desc" => "Successfully requested")));
            }else {
                die(json_encode(array("status" => "400", "desc" => "Requested unsuccessfull")));
            }
        }
    }
}
