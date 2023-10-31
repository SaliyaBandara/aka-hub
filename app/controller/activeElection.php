<?php

class activeElection extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Elections',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('election/elections/activeElections', $data);
    }
}
