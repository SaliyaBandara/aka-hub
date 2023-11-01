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

        $this->view->render('dashboard/index', $data);
    }
}
