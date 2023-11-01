<?php

class PollCreate extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Create Polls',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('poll/pollCreate/index', $data);
    }

}
