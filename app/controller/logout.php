<?php

class Logout extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $task = "User logged out";
        $this->model("createModel")->createLogEntry($task, "604");
        session_destroy();
        header("Location: " . BASE_URL);
    }
}
