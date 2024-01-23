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

        $data["main_events"] = $this->model('readModel')->getAll("main_events");
        $this->view->render('dashboard/index', $data);
    }
}
