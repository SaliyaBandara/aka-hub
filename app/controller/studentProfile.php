<?php
class StudentProfile extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Profile',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('student/studentProfile/index', $data);
    }


}