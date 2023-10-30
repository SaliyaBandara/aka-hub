<?php
class AddClubEventsToCalendar extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Add Club Events To Calendar',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('clubRep/addClubEventsToCalendar/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Add Club Events To Calendar',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('clubRep/addClubEventsToCalendar/test', $data);
    }

}