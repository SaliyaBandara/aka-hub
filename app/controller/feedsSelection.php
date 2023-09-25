<?php
class FeedsSelection extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Feeds Selection',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/feedsSelection/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Feeds Selection',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/feedsSelection/test', $data);
    }

}