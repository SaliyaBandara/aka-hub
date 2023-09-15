<?php
class Dashboard extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('dashboard/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Login',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('dashboard/index', $data);
    }

}