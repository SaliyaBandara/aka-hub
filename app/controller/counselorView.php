<?php

class CounselorView extends Controller
{
    public function index()
    {
        $this->requireLogin();

        $data = [
            'title' => 'Counselor Details',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('student/counselor/view', $data);
    }
}