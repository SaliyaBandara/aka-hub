<?php
class ExistingCounselors extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Existing Counselors',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('existingCounselors/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Existing Counselors',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('existingCounselors/test', $data);
    }

}