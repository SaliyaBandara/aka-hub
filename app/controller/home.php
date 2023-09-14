<?php

class Home extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home Page',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('home/index', $data);
    }
}
