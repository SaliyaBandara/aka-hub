<?php
class ViewUserDistribution extends Controller{
    public function index()
    {
        $data = [
            'title' => 'User Distribution',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/viewUserDistribution/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'User Distribution',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/viewUserDistribution/test', $data);
    }

}