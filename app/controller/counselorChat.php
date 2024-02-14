<?php

class CounselorChat extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'CounselorPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/counselorChat/index', $data);
    }
}
