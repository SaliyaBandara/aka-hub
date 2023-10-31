<?php
class ApproveRepresentatives extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/approveRepresentatives/index', $data);
    }

    public function test(){
        $this->requireLogin();
        $data = [
            'title' => 'Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/approveRepresentatives/test', $data);
    }

}