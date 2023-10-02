<?php
class ApproveRepresentatives extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/approveRepresentatives/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/approveRepresentatives/test', $data);
    }

}