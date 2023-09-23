<?php

class PollCreate extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Create Polls',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('pollCreate/index', $data);
    }

}
