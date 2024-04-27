<?php
class ViewUserDistribution extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to view User Distribution";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'User Distribution',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["users"] = $this->model('readModel')->getAllUsers();
        if (!$data["users"])
            $data["users"] = array();
        $this->view->render('admin/viewUserDistribution/index', $data);
    }

    public function previewUser($id)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to Preview User Details";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'User Distribution',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["user"] = $this->model('readModel')->getPreviewUser($id);
        $data["id"] = $id;
        $data["isRestricted"] = $this->model('readModel')->findWhetherRestricted($id);
        $this->view->render('admin/viewUserDistribution/previewUser', $data);
    }

    public function restrictUser($id)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to Restrict User";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }

        $isRestricted = $this->model('readModel')->findWhetherRestricted($id);

        if($isRestricted){
            $result = $this->model('updateModel')->removeRestriction($id);
            if ($result) {
                $action = "User with ID: " . $id . "restriction has been removed";
                $status = "606";
                $this->model("createModel")->createLogEntry($action, $status);
                die(json_encode(array("status" => "200", "desc" => "Restriction removed Successfully")));
            } else {
                $action = "User with ID: " . $id . " could not be restricted";
                $status = "400";
                $this->model("createModel")->createLogEntry($action, $status);
                die(json_encode(array("status" => "400", "desc" => "Restriction removing Unsuccessfull")));
            }
        }else{
            $result = $this->model('updateModel')->restrictUser($id);
            if ($result) {
                $action = "User with ID: " . $id . " has been restricted";
                $status = "607";
                $this->model("createModel")->createLogEntry($action, $status);
                die(json_encode(array("status" => "200", "desc" => "Restricting Successfull")));
            } else {
                $action = "User with ID: " . $id . " could not be restricted";
                $status = "400";
                $this->model("createModel")->createLogEntry($action, $status);
                die(json_encode(array("status" => "400", "desc" => "Restricting Unsuccessfull")));
            }
        }
    }
}
