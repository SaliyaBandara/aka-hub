<?php
class AddCounselors extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Counselors Adding',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/addCounselors/index', $data);
    }

    public function test(){
        $this->requireLogin();
        $data = [
            'title' => 'Counselors Adding',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/addCounselors/test', $data);
    }

}