<?php
class CounselorFeed extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Counselor Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/counselorFeed/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Counselor Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/counselorFeed/index', $data);
    }

}