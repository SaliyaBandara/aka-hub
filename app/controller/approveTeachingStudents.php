<?php
class ApproveTeachingStudents extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Teaching Student Approvals',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["approveRequests"] = $this->model('readModel')->getTeachingStudentsToApprove();
        $this->view->render('studentRep/approveTeachingStudents/index', $data);
    }

    public function previewRepresentative($id)
    {
        $this->requireLogin();
        $data = [
            'title' => 'Teaching Student Approvals',
            'message' => 'Welcome to Aka Hub!',
        ];
        $data["previewRepresentative"] = $this->model('readModel')->getPreviewRepresentative($id);
        $this->view->render('studentRep/approveTeachingStudents/previewRepresentatives', $data);
    }

    public function acceptRole($id, $role)
    {
        print_r($id, $role);
        $this->requireLogin();
        $result = $this->model('updateModel')->to_get_role(
            "user",
            $role,
            $id,
            1
        );
        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Accepting Successfull")));
        else {
            die(json_encode(array("status" => "400", "desc" => "Accepting Unsuccessfull")));
        }
    }
    public function declineRole($id = 0, $role = 0)
    {
        print_r($id, $role);
        $this->requireLogin();
        $result = $this->model('updateModel')->to_get_role(
            "user",
            $role,
            $id,
            0
        );
        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Denying Successfull")));
        else {
            die(json_encode(array("status" => "400", "desc" => "Denying unsuccessfull")));
        }
    }
}
