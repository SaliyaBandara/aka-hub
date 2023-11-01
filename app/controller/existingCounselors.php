<?php
class ExistingCounselors extends Controller
{
    public function index()
    {

        $this->requireLogin();
        if ($_SESSION["user_role"] != 1)
            $this->redirect();

        $data = [
            'title' => 'Existing Counselors',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["counselors"] = $this->model('readModel')->getCounselors();
        $this->view->render('admin/existingCounselors/index', $data);
    }

    // delete
    public function delete($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1)
            $this->redirect();

        if ($id == 0)
            $this->redirect();

        $result = $this->model('deleteModel')->deleteOne("user", $id);
        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));

        die(json_encode(array("status" => "400", "desc" => "Error while deleting course")));
    }
}
