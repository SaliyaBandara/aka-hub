<?php
class CalendarAdminView extends Controller
{

    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Calendar Events List',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["items"] = $this->model('readModel')->getAllCalendarEvents();

        $this->view->render('admin/calendarAdminView/calendarAdminView', $data);
    }

}    