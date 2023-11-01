<?php
class FeedsSelection extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Feeds Selection',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/feedsSelection/index', $data);
    }

    public function test(){
        $this->requireLogin();
        $data = [
            'title' => 'Feeds Selection',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/feedsSelection/test', $data);
    }

}