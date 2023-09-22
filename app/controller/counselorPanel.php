<?php

class CounselorPanel extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'CounselorPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselorpanel/index', $data);
    }
}
