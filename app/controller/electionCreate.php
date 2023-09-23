<?php

class ElectionCreate extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Create Elections',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('electionCreate/index', $data);
    }

}
