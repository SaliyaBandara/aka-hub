<?php
class CommonProfile extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('commonProfile/index', $data);
    }

}