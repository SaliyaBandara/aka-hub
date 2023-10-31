<?php

class Home extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Home Page',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('home/index', $data);
    }
}
