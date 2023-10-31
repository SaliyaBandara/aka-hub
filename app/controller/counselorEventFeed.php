<?php
class CounselorEventFeed extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Counselor Event Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/counselorFeed/index', $data);
    }
}