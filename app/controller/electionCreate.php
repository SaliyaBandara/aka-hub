<?php

class ElectionCreate extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Create Elections',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('election/electionCreate/index', $data);
    }

}
