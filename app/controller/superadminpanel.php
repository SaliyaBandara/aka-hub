<?php
class SuperAdminPanel extends Controller{
    public function index()
    {
        $data = [
            'title' => 'SuperAdminPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('superadmin/superadminpanel/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'SuperAdminPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('superadmin/superadminpanel/test', $data);
    }

}