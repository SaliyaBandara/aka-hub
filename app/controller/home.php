<?php

class Home extends Controller
{
    public function index()
    {
<<<<<<< HEAD

        if($this->isLoggedIn()){
            $this->redirect("dashboard");
        }

=======
        $this->requireLogin();
>>>>>>> 8b281836935fd6cfa559f6c17eca18c58a6f7644
        $data = [
            'title' => 'Home Page',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('home/index', $data);
    }
}
