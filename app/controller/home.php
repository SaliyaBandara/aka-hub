<?php

class Home extends Controller
{
    public function index()
    {

        if($this->isLoggedIn()){
            $this->redirect("dashboard");
        }

        $data = [
            'title' => 'Home Page',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('home/index', $data);
    }
}
