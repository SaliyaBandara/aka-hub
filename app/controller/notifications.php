<?php
class Notifications extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/");
        die();
    }

    public function view($id = 0)
    {
        $this->requireLogin();
        $this->redirect();
    }

    public function get_notifications()
    {
        $this->requireLogin();
        $notifications = $this->model('readModel')->getNotifications();
        die(json_encode(array("status" => "200", "desc" => "Success", "notifications" => $notifications)));
        // print_r($notifications);
    }
}
