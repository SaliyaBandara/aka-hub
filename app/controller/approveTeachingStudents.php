<?php
class ApproveTeachingStudents extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Teaching Student Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('studentRep/approveTeachingStudents/index', $data);
    }

    public function test(){
        $this->requireLogin();
        $data = [
            'title' => 'Teaching Student Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('studentRep/approveTeachingStudents/test', $data);
    }

}