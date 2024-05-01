<?php
class ApproveRepresentatives extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to view Approve Representatives page";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
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
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to preview Representatives page";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
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
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to preview Admin Access Control page";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'Rep Approvement',
            'message' => 'Welcome to Aka Hub!',
        ];
        $data["previewRepresentative"] = $this->model('readModel')->getPreviewRepresentativeWithClub($id);
        $this->view->render('admin/approveRepresentatives/previewAccessControl', $data);
    }
    public function acceptRole($id, $role)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to accept Role";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }

        if ($role == "club_rep") {
            $resultUserUpdate = $this->model('updateModel')->to_get_role(
                "user",
                $role,
                $id,
                1
            );

            $resultStatusUpdate = $this->model('updateModel')->to_update_status("club_representative", $id);

            if ($resultUserUpdate && $resultStatusUpdate) {
                $action = "Admin successfully accepted role of Club Representative";
                $status = "606";
                $this->model("createModel")->createLogEntry($action, $status);

                $this->model("createModel")->notification(7, 0, $id, "Promoted to Club Representative","You Have Been Promoted to Club Representative Role and Features", 0);

                die(json_encode(array("status" => "200", "desc" => "Accepting Successfull")));
            } else {
                die(json_encode(array("status" => "400", "desc" => "Accepting Unsuccessfull")));
            }
        } else if ($role == "student_rep") {
            $resultUserUpdate = $this->model('updateModel')->to_get_role(
                "user",
                $role,
                $id,
                1
            );

            if ($resultUserUpdate) {
                $action = "Admin successfully accepted role of Student Representative";
                $status = "606";
                $this->model("createModel")->createLogEntry($action, $status);

                $this->model("createModel")->notification(7, 0, $id, "Promoted to Student Representative","You Have Been Promoted to Student Representative Role and Features", 0);

                die(json_encode(array("status" => "200", "desc" => "Accepting Successfull")));
            } else {
                die(json_encode(array("status" => "400", "desc" => "Accepting Unsuccessfull")));
            }
        }
    }
    public function declineRole($id = 0, $role = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to decline Role";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $result = $this->model('updateModel')->to_get_role(
            "user",
            $role,
            $id,
            0
        );

        if ($role == "club_rep") {
            $result1 = $this->model('deleteModel')->deleteOne("club_representative", $id);

            if ($result && $result1) {
                $action = "Admin successfully declined role";
                $status = "200";
                $this->model("createModel")->createLogEntry($action, $status);

                $this->model("createModel")->notification(7, 0, $id, "Promotion Request to Club Rep Rejected","Sorry , You are not Promoted to Club Representative Role and Features", 0);

                die(json_encode(array("status" => "200", "desc" => "Denying Successfull")));
            } else {
                die(json_encode(array("status" => "400", "desc" => "Denying unsuccessfull")));
            }
        } else if ($role == "student_rep") {
            if ($result) {
                $action = "Admin successfully declined role";
                $status = "200";
                $this->model("createModel")->createLogEntry($action, $status);

                $this->model("createModel")->notification(7, 0, $id,"Promotion Request to Student Rep Rejected", "Sorry , You are not Promoted to Student Representative Role and Features", 0);

                die(json_encode(array("status" => "200", "desc" => "Denying Successfull")));
            } else {
                die(json_encode(array("status" => "400", "desc" => "Denying unsuccessfull")));
            }
        }
    }

    public function adminAccessControlView()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to view Admin Access Control page";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
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
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to remove Access";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
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
                $action = "Admin successfully removed Access";
                $status = "607";
                $this->model("createModel")->createLogEntry($action, $status);

                $this->model("createModel")->notification(7, 0, $id, "Club Rep Permissions Revoked","Sorry , Your Club Representative Permissions and Features Revoked", 0);

                die(json_encode(array("status" => "200", "desc" => "Denying Successfull")));
            } else {
                die(json_encode(array("status" => "400", "desc" => "Denying unsuccessfull")));
            }
        } else {
            if ($result1) {
                $action = "Admin successfully removed Access";
                $status = "607";
                $this->model("createModel")->createLogEntry($action, $status);

                $this->model("createModel")->notification(7, 0, $id,"Student Rep Permissions Revoked", "Sorry , Your Student Representative Permissions and Features Revoked", 0);

                die(json_encode(array("status" => "200", "desc" => "Denying Successfull")));
            } else {
                die(json_encode(array("status" => "400", "desc" => "Denying unsuccessfull")));
            }
        }
    }
}
