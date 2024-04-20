<?php
class AdminAccessControl extends Controller{
    public function index()
    {   
        $this->requireLogin();
        $data = [
            'title' => 'Admin Access Control',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["accessUsers"]=$this->model('readModel')->getUsersToLimitAccess();
        $this->view->render('admin/adminAccessControl/index', $data);
    }

    public function preview(){
        $data = [
            'title' => 'Admin Access Control',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/adminAccessControl/previewAccessAdmin', $data);
    }

}