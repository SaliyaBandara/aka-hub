<?php
class Feeds extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Feeds',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('feeds/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Feeds',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('feeds/test', $data);
    }

}