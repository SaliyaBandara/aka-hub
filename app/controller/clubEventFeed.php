<?php
class ClubEventFeed extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Club Event Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('clubRep/clubEventFeed/index', $data);
    }

    public function test(){
        $this->requireLogin();
        $data = [
            'title' => 'Club Event Feed',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('clubRep/clubEventFeed/index', $data);
    }

}