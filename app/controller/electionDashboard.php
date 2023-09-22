<?php

class ElectionDashboard extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Elections',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('electionDashboard/index', $data);
    }

}
