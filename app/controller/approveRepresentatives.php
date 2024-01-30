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

    public function previewRepresentative($id)
    {
        $this->requireLogin();
        $data = [
            'title' => 'Rep Approvement',
            'message' => 'Welcome to Aka Hub!',
        ];
        $data["previewRepresentative"] = $this->model('readModel')->getPreviewRepresentative($id);
        $this->view->render('admin/approveRepresentatives/previewRepresentative', $data);
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
            die(json_encode(array("status" => "200", "desc" => "Accepting Successfull")));
        else {
            die(json_encode(array("status" => "400", "desc" => "Accepting Unsuccessfull")));
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
            die(json_encode(array("status" => "200", "desc" => "Denying Successfull")));
        else {
            die(json_encode(array("status" => "400", "desc" => "Denying unsuccessfull")));
        }
    }
}
