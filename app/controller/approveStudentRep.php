<?php
class ApproveStudentRep extends Controller{
    public function index()
    {
        $data = [
            'title' => 'Student Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/approveStudentRep/index', $data);
    }

    public function test(){
        $data = [
            'title' => 'Student Rep Approvement',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/approveStudentRep/test', $data);
    }

}