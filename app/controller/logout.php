<?php

class Logout extends Controller
{
    public function index()
    {
        session_destroy();
        header("Location: " . BASE_URL);
    }
}
