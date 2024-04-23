<?php

class ElectionDashboard extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'Elections',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["electionsOngoing"] = $this->model('readModel')->getOngoingElections("elections");
        $data["electionsPrevious"] = $this->model('readModel')->getPreviousElections("elections");
        $this->view->render('election/electionDashboard/index', $data);
    }

}
