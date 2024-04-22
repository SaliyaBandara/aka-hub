<?php
class AdminAccessControl extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Admin Access Control',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["accessUsers"] = $this->model('readModel')->getUsersToLimitAccess();
        $this->view->render('admin/adminAccessControl/index', $data);
    }

    public function preview($id)
    {
        $data = [
            'title' => 'Admin Access Control',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["previewRepresentative"] = $this->model('readModel')->getPreviewRepresentative($id);
        $this->view->render('admin/adminAccessControl/previewAccessAdmin', $data);
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
