<?php
class AddAdmin extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Admin Account Creation',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('superadmin/addAdmin/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Admin Account Creation',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('superadmin/addAdmin/test', $data);
    }

}