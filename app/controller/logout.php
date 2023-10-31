<?php

class Logout extends Controller
{
    public function index()
    {
        $this->requireLogin();
        session_destroy();
        header("Location: " . BASE_URL);
    }
}
