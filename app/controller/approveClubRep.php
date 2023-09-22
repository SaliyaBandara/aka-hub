<?php
class ApproveClubRep extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Club Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('approveClubRep/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Club Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('approveClubRep/test', $data);
    }

}