<?php

class LiveResults extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'LiveResults',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('election/liveResults/index', $data);
    }
}
