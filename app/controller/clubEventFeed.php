<?php
class ClubEventFeed extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Club Event Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('clubEventFeed/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Club Event Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('clubEventFeed/index', $data);
    }

}