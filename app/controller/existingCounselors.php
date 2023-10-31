<?php
class ExistingCounselors extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Existing Counselors',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/existingCounselors/index', $data);
    }

    public function test(){
        $this->requireLogin();
        $data = [
            'title' => 'Existing Counselors',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/existingCounselors/test', $data);
    }

}