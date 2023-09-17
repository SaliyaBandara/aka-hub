<?php
class ApproveByAdmin extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Student Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('approveByAdmin/studentreps', $data);
    }

    public function test(){
        $data = [
            'title' => 'Club Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('approveByAdmin/clubreps', $data);
    }

}