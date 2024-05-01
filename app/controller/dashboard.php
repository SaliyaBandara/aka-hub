<?php

class Dashboard extends Controller
{
    public function index()
    {
        $this->requireLogin();

        $data = [
            'title' => 'Dashboard',
            'message' => 'Welcome to Aka Hub!'
        ];

        $user_id = $_SESSION["user_id"];
        $student = $this->model('readModel')->getOne("student" , $user_id);
        $year = $student["year"];

        $data["main_events"] = $this->model('readModel')->getAllEvents($year);

        // if(empty($data["main_events"])){
        //     echo "<div class='font-medium text-muted'>You don't have any upcoming tasks!</div>";
        // }
        $this->view->render('dashboard/index', $data);
    }

    public function view($id)
    {
        $this->requireLogin();

        $data = [
            'title' => 'Dashboard',
            'message' => 'Welcome to Aka Hub!'
        ];

        // $user_id = $_SESSION["user_id"];
        // $student = $this->model('readModel')->getOne("student" , $user_id);
        // $year = $student["year"];

        $data["event"] = $this->model('readModel')->getAllCalendarEventsById($id);

        $date = date("l, j F Y", strtotime($data["event"][0]["date"]));
        $data["date"] = $date;

        // if(empty($data["main_events"])){
        //     echo "<div class='font-medium text-muted'>You don't have any upcoming tasks!</div>";
        // }
        $this->view->render('dashboard/view', $data);
    }
}
