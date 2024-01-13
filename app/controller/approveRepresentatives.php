<?php
class ApproveRepresentatives extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["approveRequests"] = $this->model('readModel')->getRequestsToApprove();
        $this->view->render('admin/approveRepresentatives/index', $data);
    }

    public function test()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/approveRepresentatives/test', $data);
    }

    public function acceptRole($id, $role)
    {
        $this->requireLogin();
        $result = $this->model('updateModel')->to_get_role(
            "user",
            $role,
            $id,
            1
        );
        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Successfully updated to be a $role")));
        else {
            die(json_encode(array("status" => "400", "desc" => "Accepting a $role is unsuccessfull")));
        }
    }
    public function declineRole($id = 0, $role = 0)
    {
        $this->requireLogin();
        $result = $this->model('updateModel')->to_get_role(
            "user",
            $role,
            $id,
            0
        );
        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Successfully denied the request to be a $role")));
        else {
            die(json_encode(array("status" => "400", "desc" => "Denying  a $role is unsuccessfull")));
        }
    }
}
