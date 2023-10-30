<?php
class AdminPanel extends Controller{
    public function index()
    {
        $data = [
            'title' => 'AdminPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/adminpanel/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'AdminPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/adminpanel/test', $data);
    }

}