<?php
class AddCounselors extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Counselors Adding',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('addCounselors/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Counselors Adding',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('addCounselors/test', $data);
    }

}