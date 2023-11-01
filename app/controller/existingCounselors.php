<?php
class ExistingCounselors extends Controller
{
    public function index()
    {
<<<<<<< HEAD

        $this->requireLogin();
        if ($_SESSION["user_role"] != 1)
            $this->redirect();

=======
        $this->requireLogin();
>>>>>>> 8b281836935fd6cfa559f6c17eca18c58a6f7644
        $data = [
            'title' => 'Existing Counselors',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["counselors"] = $this->model('readModel')->getCounselors();
        $this->view->render('admin/existingCounselors/index', $data);
    }

<<<<<<< HEAD
    // delete
    public function delete($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1)
            $this->redirect();
=======
    public function test(){
        $this->requireLogin();
        $data = [
            'title' => 'Existing Counselors',
            'message' => 'Welcome to Aka Hub!'
        ];
>>>>>>> 8b281836935fd6cfa559f6c17eca18c58a6f7644

        if ($id == 0)
            $this->redirect();

        $result = $this->model('deleteModel')->deleteOne("user", $id);
        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));

        die(json_encode(array("status" => "400", "desc" => "Error while deleting course")));
    }
}
