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
    public function previewAdminAccessControl($id)
    {
        $this->requireLogin();
        $data = [
            'title' => 'Rep Approvement',
            'message' => 'Welcome to Aka Hub!',
        ];
        $data["previewRepresentative"] = $this->model('readModel')->getPreviewRepresentative($id);
        $this->view->render('admin/approveRepresentatives/previewAccessControl', $data);
    }
    public function acceptRole($id, $role)
    {
        $this->requireLogin();
        if($role == "club_rep"){
            $resultUserUpdate = $this->model('updateModel')->to_get_role(
                "user",
                $role,
                $id,
                1
            );

            $resultStatusUpdate = $this->model('updateModel')->to_update_status("club_representative",$id);

            if ($resultUserUpdate && $resultStatusUpdate)
                die(json_encode(array("status" => "200", "desc" => "Accepting Successfull")));
            else {
                die(json_encode(array("status" => "400", "desc" => "Accepting Unsuccessfull")));
            }
        }
        else{
            $resultUserUpdate = $this->model('updateModel')->to_get_role(
                "user",
                $role,
                $id,
                1
            );

            if ($resultUserUpdate)
                die(json_encode(array("status" => "200", "desc" => "Accepting Successfull")));
            else {
                die(json_encode(array("status" => "400", "desc" => "Accepting Unsuccessfull")));
            }
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

    public function adminAccessControlView()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Admin Access Control',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["accessUsers"] = $this->model('readModel')->getUsersToLimitAccess();
        $this->view->render('admin/approveRepresentatives/adminAccessControl', $data);
    }

    public function removeAccess($id = 0, $role = 0)
    {
        $this->requireLogin();
        $result1 = $this->model('updateModel')->to_get_role(
            "user",
            $role,
            $id,
            0
        );
        if ($role == "club_rep") {
            $result2 = $this->model('deleteModel')->deleteOneClubRep(
                "club_representative",
                $id,
            );
            if ($result1 * $result2) {
                die(json_encode(array("status" => "200", "desc" => "Denying Successfull")));
            } else {
                die(json_encode(array("status" => "400", "desc" => "Denying unsuccessfull")));
            }
        } else {
            if ($result1) {
                die(json_encode(array("status" => "200", "desc" => "Denying Successfull")));
            } else {
                die(json_encode(array("status" => "400", "desc" => "Denying unsuccessfull")));
            }
        }
    }
}
