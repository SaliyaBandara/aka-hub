<?php

class activeCourses extends Controller
{
    public function index()
    {   
        $this->requireLogin();
        $data = [
            'title' => 'Active Courses',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('student/courses/activeCourses/index', $data);
    }
}
