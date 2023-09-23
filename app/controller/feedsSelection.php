<?php
class FeedsSelection extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Feeds Selection',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('feedsSelection/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Feeds Selection',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('feedsSelection/test', $data);
    }

}