<?php

class activeElection extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Elections',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('activeElection/index', $data);
    }

}
