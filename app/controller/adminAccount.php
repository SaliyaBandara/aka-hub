<?php
class AdminAccount extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Admin Account Details',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('superadmin/adminAccount/index', $data);
    }

    public function test(){
        $this->requireLogin();
        $data = [
            'title' => 'Admin Account Details',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('superadmin/adminAccount/test', $data);
    }

}