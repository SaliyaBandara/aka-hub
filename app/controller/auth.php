<?php

class Auth extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('auth/index', $data);
    }

    public function login(){
        
    }
}
