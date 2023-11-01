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
<<<<<<< HEAD
=======

    public function test()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Login',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('dashboard/index', $data);
    }
>>>>>>> 8b281836935fd6cfa559f6c17eca18c58a6f7644
}
