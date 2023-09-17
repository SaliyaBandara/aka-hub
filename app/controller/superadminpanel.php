<?php
class SuperAdminPanel extends Controller{
    public function index()
    {
        $data = [
            'title' => 'SuperAdminPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('superadminpanel/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'SuperAdminPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('superadminpanel/test', $data);
    }

}