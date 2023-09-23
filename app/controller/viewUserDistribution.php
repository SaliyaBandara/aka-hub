<?php
class ViewUserDistribution extends Controller{
    public function index()
    {
        $data = [
            'title' => 'User Distribution',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('viewUserDistribution/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'User Distribution',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('viewUserDistribution/test', $data);
    }

}