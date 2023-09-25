<?php
class ApproveSelectionbyAdmin extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Feeds Selection',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/approveSelectionbyAdmin/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Feeds Selection',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/approveSelectionbyAdmin/test', $data);
    }

}