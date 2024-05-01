<?php
class ExistingCounselors extends Controller
{
    public function index()
    {

        $this->requireLogin();
        // if ($_SESSION["user_role"] != 1)
        //     $this->redirect();

        $data = [
            'title' => 'Existing Counselors',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["role"] = $_SESSION["user_role"];
        $data["counselors"] = $this->model('readModel')->getCounselors();
        if (!$data["counselors"])
            $data["counselors"] = array();
        $this->view->render('admin/existingCounselors/index', $data);
    }

    // delete
    public function delete($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to delete a specific counselor";
            $state = 401;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        if ($id == 0)
            $this->redirect();

        $resultOne = $this->model('deleteModel')->deleteOne("counselor", $id);
        $resultTwo = $this->model('deleteModel')->deleteOne("user", $id);


        if ($resultOne && $resultTwo) {
            $action = "deleted a specific counselor : " . $id;
            $state = 602;
            $this->model("createModel")->createLogEntry($action, $state);
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));
        }
        die(json_encode(array("status" => "400", "desc" => "Error while deleting course")));
    }
}
