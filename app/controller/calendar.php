<?php
class Calendar extends Controller
{
    public function student_view()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Calendar',
            'message' => 'Welcome to Aka Hub!'
        ];
        
        $this->view->render('/public/components/common/calendar/studentView.php', $data);
    }

    public function club_view()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Calendar',
            'message' => 'Welcome to Aka Hub!'
        ];
        
        $this->view->render('/public/components/common/calendar/clubView.php', $data);
    }

    public function student_rep_view()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Calendar',
            'message' => 'Welcome to Aka Hub!'
        ];
        
        $this->view->render('/public/components/common/calendar/studentRepView.php', $data);
    }

}
