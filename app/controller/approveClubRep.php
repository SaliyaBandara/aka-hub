<?php
class ApproveClubRep extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Club Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/approveClubRep/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Club Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/approveClubRep/test', $data);
    }

}