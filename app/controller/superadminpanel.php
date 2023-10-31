<?php
class SuperAdminPanel extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'SuperAdminPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('superadmin/superadminpanel/index', $data);
    }

    public function test(){
        $this->requireLogin();
        $data = [
            'title' => 'SuperAdminPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('superadmin/superadminpanel/test', $data);
    }

}