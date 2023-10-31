<?php
class AddAcademicDueDatesToCalendar extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Add Aceademic Due Dates To Calendar',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('studentRep/addAcademicDueDatesToCalendar/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Add Aceademic Due Dates To Calendar',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('studentRep/addAcademicDueDatesToCalendar/test', $data);
    }

}